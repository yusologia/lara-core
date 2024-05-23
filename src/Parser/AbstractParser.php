<?php

namespace Logia\Core\Parser;

use Logia\Core\Parser\Builder\ParserBuilder;

/**
 * @method static get($data, ...$_args)
 * @method static first($data, ...$_args)
 */
abstract class AbstractParser implements Contract\AbstractParser
{
    /**
     * @param $data
     * @param ...$args
     *
     * @return mixed
     */
    public static function response($data, ...$args)
    {
        $builder = new ParserBuilder($data, ...$args);
        $builder->setParserClass();
        $builder->setMethod();

        return (new static)->handle($builder);
    }

    /**
     * @param $method
     * @param ...$args
     *
     * @return mixed
     */
    public static function custom($method, ...$args)
    {
        $data = null;
        if (count($args) > 0) {
            $data = $args[0];
            unset($args[0]);
        }

        $builder = new ParserBuilder($data, ...$args);
        $builder->setParserClass();
        $builder->setMethod($method);

        return (new static)->handle($builder);
    }


    /**
     * @param $method
     * @param $arguments
     *
     * @return mixed
     * @throws \Exception
     */
    public static function __callStatic($method, $arguments)
    {
        if (!method_exists(BaseParser::class, $method)) {

            if (!$arguments || $arguments === null) {
                throw new \Exception("arguments in #$method does not exists");
            }

            return self::custom($method, ...$arguments);

        }

        $data = null;
        if (count($arguments) > 0) {
            $data = $arguments[0];
            unset($arguments[0]);
        }

        return self::response($data, ...$arguments);
    }

    abstract public function handle(ParserBuilder $builder);

}
