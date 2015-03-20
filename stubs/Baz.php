<?php
namespace Stubs;

class Baz
{
    private $qux;

    public function __construct(Qux $qux)
    {
        $this->qux = $qux;
    }
}
