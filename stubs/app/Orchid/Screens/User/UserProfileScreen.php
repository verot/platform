<?php

declare(strict_types=1);

namespace App\Orchid\Screens\User;

use App\Orchid\Layouts\User\UserEditLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Orchid\Platform\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class UserProfileScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'My account';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Update your account details such as name, email address and password';

    /**
     * @var User
     */
    protected $user;

    /**
     * Query data.
     *
     * @param Request $request
     *
     * @return array
     */
    public function query(Request $request): array
    {
        $this->user = $request->user();

        return [
            'user' => $this->user,
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::block(UserEditLayout::class)
                ->title(__('Profile Information'))
                ->description(__('Update your account\'s profile information and email address.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                ),


            Layout::block(Layout::rows([
                Password::make('old_password')
                    ->placeholder(__('Enter the current password'))
                    ->title(__('Old password'))
                    ->help('This is your password set at the moment.'),

                Password::make('password')
                    ->placeholder(__('Enter the password to be set'))
                    ->title(__('New password')),

                Password::make('password_confirmation')
                    ->placeholder(__('Enter the password to be set'))
                    ->title(__('Confirm new password'))
                    ->help('A good password is at least 15 characters or at least 8 characters long, including a number and a lowercase letter.'),
            ]))
                ->title(__('Update Password'))
                ->description(__('Ensure your account is using a long, random password to stay secure.'))
                ->commands(
                    Button::make(__('Change Password'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                ),
        ];
    }

    /**
     * @param Request $request
     */
    public function save(Request $request)
    {
        $request->validate([
            'user.name'  => 'required|string',
            'user.email' => [
                'required',
                Rule::unique(User::class, 'email')->ignore($request->user()),
            ],
        ]);

        $request->user()
            ->fill($request->get('user'))
            ->save();

        Toast::info(__('Profile updated.'));
    }

    /**
     * @param Request $request
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|password:web',
            'password'     => 'required|confirmed',
        ]);

        tap($request->user(), function ($user) use ($request) {
            $user->password = Hash::make($request->get('password'));
        })->save();

        Toast::info(__('Password changed.'));
    }
}
