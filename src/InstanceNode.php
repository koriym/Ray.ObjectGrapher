<?php

declare(strict_types=1);

namespace Ray\ObjectGrapher;

use Ray\Di\Instance;
use function htmlspecialchars;

final class InstanceNode implements NodeInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $interface;

    /**
     * @var string
     */
    private $named;

    public function __construct(string $id, string $interface, string $named, Instance $instance)
    {
        $this->id = $id;
        $this->interface = htmlspecialchars(str_replace('\\', '\\\\', $interface));
        $this->named = $named ? "@<font color=\"#000000\" point-size=\"10\">{$named}<br align=\"left\"/></font>" : '';
        $this->type = mb_strimwidth(addslashes((string)$instance) , 0, 48, '..');
    }

    public function __toString()
    {
        return /* @lang html */
            <<< EOT
{$this->id} [style=solid, margin=0.02, label=<<table cellspacing="0" cellpadding="5" cellborder="0" border="0"><tr><td align="left" port="header" bgcolor="#aaaaaa">{$this->named}<font color="#000000">{$this->type}<br align="left"/></font></td></tr></table>>, shape=box]
EOT;
    }
}
