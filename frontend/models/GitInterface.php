<?php

namespace frontend\models;

interface GitInterface
{
    public function accept(GitHandlerInterface $gitHandlerInterface): array;
}