<?php

namespace Collect;

class Collect
{
    private array $array = [];

    public function __construct(array $array = [])
    {
        $this->array = $array;
    }

    public function keys(): Collect
    {
        return new self(array_keys($this->array));
    }

    public function values(): Collect
    {
        return new self(array_values($this->array));
    }

    public function get($key = null)
    {
        return $this->array[$key] ?? $this->array;
    }

    public function except(...$attrs): Collect
    {
        if (gettype($attrs[0]) === 'array') {
            $attrs = $attrs[0];
        }
        return collection(array_diff_key($this->array, array_flip($attrs)));
    }

    public function only(...$attrs): Collect
    {
        if (gettype($attrs[0]) === 'array') {
            $attrs = $attrs[0];
        }
        return new self(array_intersect_key($this->array, array_flip($attrs)));
    }

    public function first()
    {
        return $this->array[array_key_first($this->array)];
    }

    public function count(): int
    {
        return count($this->array);
    }

    public function toArray(): array
    {
        return $this->array;
    }

    public function search($key, $value): Collect
    {
        $tmp = array_keys(array_column($this->array, $key), $value);

        return (new self($tmp))->map(function ($idx) {
            return $this->array[$idx];
        });
    }

    public function map(callable $callback): Collect
    {
        return new self(array_map($callback, $this->array));
    }

    //3
    public function filter(callable $callback): Collect
    {
        return new self(array_filter($this->array, $callback));
    }

    public function each(callable $callback, ...$args): Collect
    {
        foreach ($this->array as $key => $item) {
            $callback($item, $key, ...$args);
        }
        return $this;
    }

    public function push($value, $key = null): Collect
    {
        if (gettype($value) === 'array') {
            $value = new self($value);
        }
        if ($key) {
            $this->array[$key] = $value;
        } else {
            $this->array[] = $value;
        }
        return $this;
    }

    public function unshift($value): Collect
    {
        array_unshift($this->array, $value);
        return $this;
    }

    public function shift(): Collect
    {
        array_shift($this->array);
        return $this;
    }

    public function pop(): Collect
    {
        array_pop($this->array);
        return $this;
    }

    public function splice($idx, $length = 1): Collect
    {
        array_splice($idx, $length);
        return $this;
    }
}