<?php

declare(strict_types=1);

namespace App\Traits;

use BezhanSalleh\FilamentShield\Facades\FilamentShield;
use Filament\Facades\Filament;
use Illuminate\Support\Str;

trait CustomPageShield
{
    public static function booted(): void
    {
        static::beforeBooted();

        if (! static::canAccess()) {
            FilamentShield::addPageShieldRedirect(static::class);
        }
    }

    protected static function beforeBooted(): void
    {
        // ...
    }

    public static function canAccess(): bool
    {
        return static::checkPolicyExistsOrAnyPermissions();
    }

    protected static function checkPolicyExistsOrAnyPermissions(): bool
    {
        return Filament::auth()->check()
            && (static::checkPolicyExists() || static::checkAnyPermissions());
    }

    protected static function checkPolicyExists(): bool
    {
        return FilamentShield::getAuthProviderFQCN()::hasPolicy(static::class);
    }

    protected static function checkAnyPermissions(): bool
    {
        if (Filament::auth()->user()->can(static::getPagePermissionIdentifier())) {
            return true;
        }
        return (bool) Filament::auth()->user()->hasAnyPermission(static::getPagePermissionIdentifier());
    }

    public static function getPagePermissionIdentifier(): string
    {
        return FilamentShield::getPagePermissionPrefix() . '_' . static::getSlug();
    }

    public static function getPagePermissionName(): string
    {
        return Str::of(class_basename(static::class))
            ->beforeLast('Page')
            ->headline()
            ->toString();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess() && parent::shouldRegisterNavigation();
    }
}
