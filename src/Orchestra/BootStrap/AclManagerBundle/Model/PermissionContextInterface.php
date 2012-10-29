<?php

namespace BootStrap\AclManagerBundle\Model;

use Symfony\Component\Security\Acl\Model\AuditableEntryInterface;

interface PermissionContextInterface
{

    public function getMask();

    public function getSecurityIdentity();

    public function getPermissionType();

    public function isGranting();

    public function equals(AuditableEntryInterface $ace);
}
