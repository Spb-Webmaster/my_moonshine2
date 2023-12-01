<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use MoonShine\Decorations\Collapse;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Users';

    public function fields(): array
    {
        return [
            Block::make([
                Text::make('Имя', 'name')
                    ->hint('Обязательное поле')
                    ->required(),
                Text::make('email'),
            //    Switcher::make('Publish', 'is_publish'),

                Collapse::make('Заголовок/Алиас', [
                    Text::make('Заголовок', 'name')->required(),
                    Slug::make('Алиас', 'slug')
                        ->from('name')->unique()
                ]),

                ID::make()->sortable(),


            ]),
        ];
    }




    public function rules(Model $item): array
    {
        return [];
    }

    public function getActiveActions(): array
    {
        return ['create', 'view', 'update', 'delete', 'massDelete'];
    }

    public function filters(): array
    {
        return [
            Text::make('Имя', 'name'),
            Text::make('Email', 'email'),
        ];
    }
    public function search(): array
    {
        return ['id', 'name', 'email'];
    }
}
