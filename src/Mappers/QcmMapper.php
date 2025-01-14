<?php

class QcmMapper implements MapperInterface
{
    public static function mapToObject(array $data): Qcm
    {
        return new Qcm(
            $data['id'],
            $data['theme']
        );
    }
}
