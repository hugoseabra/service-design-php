<?php
namespace Implementation\Service\Pricing;

use Implementation\Service\Pricing\ServiceResource\ResourceFinder;
use Implementation\Service\Pricing\Parameter\ParameterFinder;
use Implementation\Service\Traits\ProportionalParameterTrait;
use Implementation\Service\Pricing\Math\StrictTypeFactory;
use Implementation\Service\Pricing\Math\FormatterFactory;
use Implementation\Service\Traits\ParameterizableTrait;
use Implementation\Service\Service;

use Service\Pricing\ServiceResource\ServiceFinancialResource;
use Service\Pricing\ServicePricing as PricingInterface;
use Service\Pricing\ServiceResource\ServiceResource;
use Service\Pricing\Math\StrictType;

use Util\Collection;

class ServicePricing extends Service implements PricingInterface
{
    use ProportionalParameterTrait;
    use ParameterizableTrait;

    /**
     * @var Collection
     */
    protected $resources;

    /**
     * @var \ArrayIterator
     */
    protected $mapConfigAsResourceInput;

    /**
     * @var \ArrayIterator
     */
    protected $mapInputAsResourceInput;

    /**
     * @var \ArrayIterator
     */
    protected $mapResultAsResourceInput;

    /**
     * ServicePricing constructor.
     * @param string $name
     * @param string $description
     * @param string $goal
     */
    public function __construct($name, $description = null, $goal = null)
    {
        parent::__construct($name, $description, $goal);

        $this->initializeCollections();
        $this->resources = new Collection();
        $this->mapConfigAsResourceInput = new \ArrayIterator();
        $this->mapInputAsResourceInput = new \ArrayIterator();
        $this->mapResultAsResourceInput = new \ArrayIterator();
    }

    /**
     * @return Collection
     */
    public function getResources()
    {
        return $this->resources;
    }

    public function addResource(ServiceResource $resource)
    {
        $this->resources->add($resource);
        return $this;
    }

    /**
     * @see \Service\Pricing\ServicePricing::addLinkFromConfigurationToResource
     * @param string $serviceConfigCode
     * @param string $resourceCode
     * @param string $resourceInputCode
     */
    public function addLinkFromConfigurationToResource($serviceConfigCode, $resourceCode, $resourceInputCode)
    {
        $this->mapConfigAsResourceInput->append([
            'serviceConfigCode' => $serviceConfigCode,
            'resourceCode' => $resourceCode,
            'resourceInputCode' => $resourceInputCode
        ]);
    }

    /**
     * @see \Service\Pricing\ServicePricing::addLinkFromInputToResource
     * @param string $serviceInputCode
     * @param string $resourceCode
     * @param string $resourceInputCode
     */
    public function addLinkFromInputToResource($serviceInputCode, $resourceCode, $resourceInputCode)
    {
        $this->mapInputAsResourceInput->append([
            'serviceInputCode' => $serviceInputCode,
            'resourceCode' => $resourceCode,
            'resourceInputCode' => $resourceInputCode
        ]);
    }

    /**
     * @see \Service\Pricing\ServicePricing::addLinkFromOperationalResourceToResource
     * @param string $operationalResourceCode
     * @param string $resourceCode
     * @param string $resourceInputCode
     */
    public function addLinkFromOperationalResourceToResource($operationalResourceCode, $resourceCode, $resourceInputCode)
    {
        $this->mapResultAsResourceInput->append([
            'operationalResourceCode' => $operationalResourceCode,
            'resourceCode' => $resourceCode,
            'resourceInputCode' => $resourceInputCode
        ]);
    }

    public function process()
    {
        $this->processMapConfigAsResourceInput();
        $this->processMapInputAsResourceInput();
        $this->processMapResultAsResourceInput();
        $this->processResources();
    }

    /**
     * @return StrictType
     */
    public function getPrice()
    {
        $this->process();

        $iterator = $this->resources->getIterator();
        $iterator->rewind();

        $resource = null;
        $price = 0;
        while ($iterator->valid()) {
            $resource = $iterator->current();

            if (!$resource instanceof ServiceFinancialResource) {
                $iterator->next();
                continue;
            }

            /**
             * @var ServiceFinancialResource $resource
             */
            $price += $resource->getResult()->getKey()->getValue();
            $iterator->next();
        }

        $result = StrictTypeFactory::create('float', $price);
        $result->setFormatter(FormatterFactory::create('money'));

        return $result;
    }

    /**
     * Process resources' math operation
     */
    protected function processResources()
    {
        if (!$this->proportionalParameter) {
            return;
        }

        $iterator = $this->resources->getIterator();
        $iterator->rewind();

        /**
         * @var ServiceResource|ServiceFinancialResource $resource
         */
        $resource = null;
        while ($iterator->valid()) {
            $resource = $iterator->current();
            if ($resource instanceof ServiceFinancialResource) {
                $resource->setProportionalParameter($this->proportionalParameter);
            }
            $resource->process();
            $iterator->next();
        }
    }

    /**
     * Inputs all configuration parameters into the resources that need as configured in mapConfigAsResourceInput()
     * @throws \Exception
     */
    protected function processMapConfigAsResourceInput()
    {
        try {
            $this->mapConfigAsResourceInput->rewind();
            while($this->mapConfigAsResourceInput->valid()) {

                /**
                 * @var array $data
                 */
                $data = $this->mapConfigAsResourceInput->current();
                $config = ParameterFinder::findFromService($this, $data['serviceConfigCode']);
                $resource = ResourceFinder::find($this->resources, $data['resourceCode']);

                $resource->input($data['resourceInputCode'], $config->getStrictType()->getValue());

                $this->mapConfigAsResourceInput->next();
            }
        } catch(\Exception $e) {
            throw new \Exception('Não foi possível mapear configurações de serviços como parâmetros de entrada de recursos.', null, $e);
        }

    }

    /**
     * Inputs all input parameters into the resources that need as configured in mapInputAsResourceInput
     * @throws \Exception
     */
    protected function processMapInputAsResourceInput()
    {
        try {
            $this->mapInputAsResourceInput->rewind();
            while($this->mapInputAsResourceInput->valid()) {

                /**
                 * @var array $data
                 */
                $data = $this->mapInputAsResourceInput->current();
                $input = ParameterFinder::findFromService($this, $data['serviceInputCode']);
                $resource = ResourceFinder::find($this->resources, $data['resourceCode']);

                $resource->input($data['resourceInputCode'], $input->getStrictType()->getValue());

                $this->mapInputAsResourceInput->next();
            }
        } catch(\Exception $e) {
            throw new \Exception('Não foi possível mapear parâmetros de entrada de serviços como parâmetros de entrada de recursos.', null, $e);
        }
    }

    /**
     * Inputs all operational resource result into the resources that need as configured in mapResultAsResourceInput
     * @throws \Exception
     */
    protected function processMapResultAsResourceInput()
    {
        try {
            $this->mapResultAsResourceInput->rewind();
            while($this->mapResultAsResourceInput->valid()) {

                /**
                 * @var array $data
                 */
                $data = $this->mapResultAsResourceInput->current();

                $resourceFrom = ResourceFinder::find($this->resources, $data['operationalResourceCode']);

                $resource = ResourceFinder::find($this->resources, $data['resourceCode']);

                $resource->input($data['resourceInputCode'], $resourceFrom->getResult()->getValue());

                $this->mapResultAsResourceInput->next();
            }
        } catch(\Exception $e) {
            throw new \Exception('Não foi possível mapear parâmetros de entrada de serviços como parâmetros de entrada de recursos.', null, $e);
        }
    }
}