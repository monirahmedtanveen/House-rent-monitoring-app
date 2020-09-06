<?php

namespace App\Nova;

use App\Models\HouseRent as HR;
use App\Nova\Metrics\RentDue;
use App\Nova\Metrics\RentPaid;
use App\Nova\Metrics\RentPartition;
use App\Nova\Metrics\TotalRent;
use Illuminate\Http\Request;
use Inspheric\Fields\Indicator;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class HouseRent extends Resource
{
    public static $group = 'Manage Rent';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\HouseRent::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'from_date', 'to_date', 'status', 'amount', 'remarks',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Renter', 'user', User::class),

            Date::make('From Date')->rules('required'),

            Date::make('To Date')->rules('required'),

            Number::make('Amount')->rules('required')->min(0)->step('0.01'),

            Number::make('Paid Amount')->min(0)->step('0.01'),

            Number::make('Due Amount')->min(0)->step('0.01'),

            Select::make('Status')->options([
                HR::PAID => HR::PAID,
                HR::DUE => HR::DUE,
            ])->rules('required')->onlyOnForms(),

            Indicator::make('Status')->labels([
                HR::PAID => HR::PAID,
                HR::DUE => HR::DUE,
            ])->colors([
                HR::PAID => 'green',
                HR::DUE => 'red',
            ]),

            Text::make('Remarks')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new RentPartition)->width('1/4'),
            (new TotalRent)->width('1/4'),
            (new RentPaid)->width('1/4'),
            (new RentDue)->width('1/4'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
