<?php

namespace Ansuman\LaraMon\Http\Livewire\Components;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Ansuman\LaraMon\Models\LaraMonRequest;

class RecentRequestsTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setPerPage(10)
            ->setPaginationEnabled()
            ->setSearchEnabled()
            ->setSortingEnabled()
            ->setBulkActionsEnabled() 
            ->setDefaultSort('created_at', 'desc')
            ->setTableAttributes([
                'class' => 'w-full table-auto border-collapse border border-gray-300 dark:border-gray-700 shadow-sm rounded-md',
            ])
            ->setTheadAttributes([
                'class' => 'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white font-semibold text-left border-b border-gray-300 dark:border-gray-700',
            ])
            ->setTbodyAttributes([
                'class' => 'divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900',
            ])
            ->setTrAttributes(function ($row, $index) {
                return [
                    'class' => 'hover:bg-gray-50 dark:hover:bg-gray-800 transition duration-200',
                ];
            })
            ->setThAttributes(function ($column) {
                return [
                    'class' => 'px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-300',
                ];
            })
            ->setTdAttributes(function ($column, $row, $index) {
                return [
                    'class' => 'px-4 py-2 text-sm text-gray-800 dark:text-gray-200',
                ];
            });
    }

    public function builder(): Builder
    {
        return LaraMonRequest::query();
    }

    public function columns(): array
    {
        return [
            Column::make('Method', 'method')
                ->sortable()
                ->searchable()
                ->format(fn($value) => "<span class='px-2 py-1 text-xs font-semibold uppercase rounded-md bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-white'>{$value}</span>")
                ->html(),

            Column::make('URL', 'url')
                ->sortable()
                ->searchable()
                ->format(fn($value) => "<span class='block truncate max-w-xs text-gray-600 dark:text-gray-300'>{$value}</span>")
                ->html(),

            Column::make('Status', 'status_code')
                ->sortable()
                ->searchable()
                ->format(fn($value) => view('laramon::livewire.components.status-badge', ['status' => $value])),

            Column::make('Time (ms)', 'execution_time')
                ->sortable()
                ->format(fn($value) => "<span class='font-medium text-gray-700 dark:text-gray-300'>{$value} ms</span>")
                ->html(),

            Column::make('Size (KB)', 'response_size')
                ->sortable()
                ->format(fn($value) => "<span class='font-medium text-gray-700 dark:text-gray-300'>" . round($value / 1024, 2) . " KB</span>")
                ->html(),

            Column::make('Created At', 'created_at')
                ->sortable()
                ->format(fn($value) => "<span class='text-gray-500 dark:text-gray-400 text-sm'>" . \Carbon\Carbon::parse($value)->diffForHumans() . "</span>")
                ->html(),
        ];
    }
}
