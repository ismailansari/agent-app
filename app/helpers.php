<?php

if (!\function_exists('create_exception_log')) {
    /**
     * @param string $msg
     * @param Throwable $exception
     * @param string|null $channel
     */
    function create_exception_log(string $msg, \Throwable $exception, ?string $channel = null, $trace = false)
    {
        $channel = null === $channel ? \config('logging.default') : $channel;

        if (!\in_array($channel, \array_keys(\config('logging.channels')))) {
            throw new \InvalidArgumentException("Invalid Log Channel `{$channel}` given");
        }
        $errorDetail = [
            'msg' => $exception->getMessage(),
            'line' => $exception->getLine(),
            'file' => $exception->getFile()
        ];
        if ($trace) {
            $errorDetail['trace'] = $exception->getTraceAsString();
        }
        \Log::channel($channel)->error($msg, $errorDetail);
    }
}
