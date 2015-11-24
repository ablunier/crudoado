<?php
namespace Crudoado\Tests\Abstractor\Eloquent;

use ANavallaSuiza\Crudoado\Abstractor\Eloquent\Relation\Translation;
use Crudoado\Tests\Models\User;
use Crudoado\Tests\TestBase;
use Mockery;
use Mockery\Mock;
use Illuminate\Database\Eloquent\Model as LaravelModel;


class TranslationTest extends TestBase
{
    /** @var  Translation */
    protected $sut;
    /** @var  Mock */
    protected $relationMock;
    /** @var  Mock */
    protected $modelManagerMock;
    /** @var  Mock */
    protected $fieldFactoryMock;

    public function setUp()
    {
        parent::setUp();

        $config = require __DIR__ . '/../../config.php';

        $this->relationMock = $this->mock('Illuminate\Database\Eloquent\Relations\Relation');
        $this->fieldFactoryMock = $this->mock('ANavallaSuiza\Crudoado\Contracts\Abstractor\FieldFactory');

        $this->sut = new Translation(
            $config['Users']['relations']['translations'],
            $this->modelManagerMock = Mockery::mock('ANavallaSuiza\Laravel\Database\Contracts\Manager\ModelManager'),
            $user = new User(),
            $user->translations(),
            $this->fieldFactoryMock
        );
    }

    public function test_implements_relation_interface()
    {
        $this->assertInstanceOf('ANavallaSuiza\Crudoado\Contracts\Abstractor\Relation', $this->sut);
    }

    public function test_get_edit_fields_returns_array_of_fields_with_proper_key()
    {
        $dbalMock = $this->mock('ANavallaSuiza\Laravel\Database\Contracts\Dbal\AbstractionLayer');

        $this->fieldFactoryMock->shouldReceive('setColumn', 'setConfig')
            ->andReturn($this->fieldFactoryMock);
        $this->fieldFactoryMock->shouldReceive('get')
            ->andReturn($fieldMock = $this->mock('ANavallaSuiza\Crudoado\Abstractor\Eloquent\Field'));

        $fieldMock->shouldReceive('setValue');

        $columnMock = $this->mock('Doctrine\DBAL\Schema\Column');

        $this->modelManagerMock->shouldReceive('getAbstractionLayer')
            ->andReturn($dbalMock);

        $columnMock = $this->mock('Doctrine\DBAL\Schema\Column');

        $dbalMock->shouldReceive('getTableColumns')
            ->once()
            ->andReturn([
                'id'      => $columnMock,
                'user_id' => $columnMock,
                'locale'  => $columnMock,
                'bio'     => $columnMock
            ]);

        $fields = $this->sut->getEditFields();

        $this->assertInternalType('array', $fields, 'getEditFields should return an array');

        $this->assertInstanceOf('ANavallaSuiza\Crudoado\Contracts\Abstractor\Field', $fields[0]);
    }

    public function test_persist()
    {
        $requestMock = $this->mock('Illuminate\Http\Request');

        $requestMock->shouldReceive('input')->with('translations')->atLeast()->once();

        $this->sut->persist($requestMock);
    }
}
