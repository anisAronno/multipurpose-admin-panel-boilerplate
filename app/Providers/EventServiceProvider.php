<?php

namespace App\Providers;

use App\Events\LoginEvent;
use App\Listeners\LoginListener;
use App\Listeners\UserRegistrationListener;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Option;
use App\Models\Product;
use App\Models\SpecialFeature;
use App\Models\Tag;
use App\Models\User;
use App\Observers\Blog\BlogObserver;
use App\Observers\CategoryObserver;
use App\Observers\ContactObserver;
use App\Observers\ImageObserver;
use App\Observers\OptionObserver;
use App\Observers\Product\ProductObserver;
use App\Observers\RoleObserver;
use App\Observers\SpecialFeatureObserver;
use App\Observers\TagObserver;
use App\Observers\User\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            UserRegistrationListener::class,
        ],
        LoginEvent::class => [
            LoginListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Role::observe(RoleObserver::class);
        Option::observe(OptionObserver::class);
        Blog::observe(BlogObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Contact::observe(ContactObserver::class);
        SpecialFeature::observe(SpecialFeatureObserver::class);
        Tag::observe(TagObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
