<?php


namespace App\Http\Mikrotik\RollbackableCommand\Delete;

class DeleteDhcpServer extends BaseDeleteRollbackableCommand
{
    /**
     * @return string
     * command that will be ran
     */
    public function getRunCommand()
    {
        return 'ip dhcp-server remove';
    }

    /**
     * @return string
     */
    public function getRollbackCommand()
    {
        return 'ip dhcp-server add';
    }

    /**
     * @return string
     */
    function name()
    {
        return 'Delete DHCP Server';
    }
}