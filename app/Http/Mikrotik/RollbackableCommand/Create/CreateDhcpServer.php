<?php


namespace App\Http\Mikrotik\RollbackableCommand\Create;


use App\Http\Mikrotik\Util\Operation;
use KhairulImam\ROSWrapper\RollbackableCommand;
use KhairulImam\ROSWrapper\Wrapper as Mikrotik;
use Exception;

/**
 * @property  mikrotik
 */
class CreateDhcpServer extends BaseCreateRollbackableCommand
{


    /**
     * @return string
     * command that will be ran
     */
    public function getRunCommand()
    {
        return 'ip dhcp-server add';
    }

    /**
     * @return string
     */
    function name()
    {
        return 'Create DHCP Network';
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRollbackCommand()
    {
        return 'ip dhcp-server remove';
    }
}