<?php

class QcmMapper
{
    public function mapToObject(array $data): Qcm
    {
        return new Qcm(
            $data['id'],
            $data['theme']
        );
    }
}
