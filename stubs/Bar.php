<?php
namespace Stubs;

class Bar
{
    private $baz;

    public function __construct(Baz $baz)
    {
        $this->baz = $baz;
    }
}
