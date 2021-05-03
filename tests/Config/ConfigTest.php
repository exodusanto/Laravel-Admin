<?php
namespace Frozennode\Administrator\Tests\Config;

use Mockery as m;
use InvalidArgumentException;
use Frozennode\Administrator\Config\Config;

class ConfigTest extends \PHPUnit\Framework\TestCase
{

    /**
     * The Validator mock
     *
     * @var Mockery
     */
    protected $validator;

    /**
     * The Config mock
     *
     * @var Mockery
     */
    protected $config;

    /**
     * The string class name
     *
     * @var string
     */
    protected $class = 'Frozennode\Administrator\Config\Config';

    /**
     * Set up function
     */
    public function setUp(): void
    {
        $this->validator = m::mock('Frozennode\Administrator\Validator');
        $this->config = m::mock('Frozennode\Administrator\Config\Config', array($this->validator, $this->validator, array('name' => 'model_name')))->makePartial();
    }

    /**
     * Tear down function
     */
    public function tearDown(): void
    {
        m::close();
    }

    public function testValidates()
    {
        $this->validator->shouldReceive('override')->once()
                        ->shouldReceive('fails')->once()->andReturn(false);
        $this->config->validateOptions();
    }

    public function testValidateFails()
    {
        $this->expectException(InvalidArgumentException::class);
        
        $this->validator->shouldReceive('override')->once()
                        ->shouldReceive('fails')->once()->andReturn(true)
                        ->shouldReceive('messages')->once()->andReturn(m::mock(array('all' => array())));
        $this->config->validateOptions();
    }

    public function testBuild()
    {
        $this->config->build();
    }

    public function testGetOptions()
    {
        $this->config->shouldReceive('validateOptions')->once()
                    ->shouldReceive('build')->once();
        $this->assertEquals($this->config->getOptions(), array('name' => 'model_name'));
    }

    public function testGetOptionWorks()
    {
        $this->config->shouldReceive('getOptions')->once()->andReturn(array('name' => 'model_name'));
        $this->assertEquals($this->config->getOption('name'), 'model_name');
    }

    public function testGetOptionThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->config->shouldReceive('getOptions')->once()->andReturn(array('name' => 'model_name'));
        $this->config->getOption('foo');
    }

    public function testValidateDataValidates()
    {
        $this->validator->shouldReceive('setData')->once()
                        ->shouldReceive('setRules')->once()
                        ->shouldReceive('setCustomMessages')->once()
                        ->shouldReceive('fails')->once();
        $this->assertEquals($this->config->validateData(array(), array(1), array()), true);
    }

    public function testValidateDataReturnsStringError()
    {
        $this->validator->shouldReceive('setData')->once()
                        ->shouldReceive('setRules')->once()
                        ->shouldReceive('setCustomMessages')->once()
                        ->shouldReceive('fails')->once()->andReturn(true)
                        ->shouldReceive('messages')->once()->andReturn(m::mock(array('all' => array())));
        ;
        $this->assertEquals($this->config->validateData(array(), array(1), array()), '');
    }
}
