<?php
namespace Collect;

function collection(array $array = []): Collect
{
    return new Collect($array);
}