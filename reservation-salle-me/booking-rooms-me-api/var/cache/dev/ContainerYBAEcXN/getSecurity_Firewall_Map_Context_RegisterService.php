<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'security.firewall.map.context.register' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/security/Http/Util/TargetPathTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/security/Http/Firewall/ExceptionListener.php';
include_once $this->targetDirs[3].'/vendor/symfony/security-bundle/Security/FirewallConfig.php';
include_once $this->targetDirs[3].'/vendor/symfony/security-bundle/Security/FirewallContext.php';

return $this->privates['security.firewall.map.context.register'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(new RewindableGenerator(function () {
    yield 0 => ($this->privates['security.channel_listener'] ?? $this->load('getSecurity_ChannelListenerService.php'));
    yield 1 => ($this->privates['security.authentication.listener.anonymous.register'] ?? $this->load('getSecurity_Authentication_Listener_Anonymous_RegisterService.php'));
    yield 2 => ($this->privates['security.access_listener'] ?? $this->load('getSecurity_AccessListenerService.php'));
}, 3), new \Symfony\Component\Security\Http\Firewall\ExceptionListener(($this->services['security.token_storage'] ?? $this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage()), ($this->privates['security.authentication.trust_resolver'] ?? $this->privates['security.authentication.trust_resolver'] = new \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver('Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken', 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken')), ($this->privates['security.http_utils'] ?? $this->load('getSecurity_HttpUtilsService.php')), 'register', NULL, NULL, NULL, ($this->privates['logger'] ?? $this->privates['logger'] = new \Symfony\Component\HttpKernel\Log\Logger()), true), NULL, new \Symfony\Bundle\SecurityBundle\Security\FirewallConfig('register', 'security.user_checker', '.security.request_matcher.u1CPh71', true, true, 'security.user.provider.concrete.entity_provider', NULL, NULL, NULL, NULL, array(0 => 'anonymous'), NULL));