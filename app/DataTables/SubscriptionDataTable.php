<?php

namespace App\DataTables;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SubscriptionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('user_name', function ($row) {
                return $row->user->full_name ?? 'N/A';
            })
            ->addColumn('plan', function ($row) {
                return $row->plan->name ?? 'N/A';
            })
            ->addColumn('status_badge', function ($row) {
                if ($row->status === 'trial') return '<span class="badge bg-info">Trial</span>';
                if ($row->status === 'pending_payment') return '<span class="badge bg-warning">Trial Ended</span>';
                if ($row->status === 'active') return '<span class="badge bg-success">Active</span>';
                return '<span class="badge bg-secondary">' . ucfirst($row->status) . '</span>';
            })
            ->editColumn('expiry_date', function ($row) {
                return $row->expiry_date ? $row->expiry_date->format('d/m/Y') : '-';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d/m/Y H:i');
            })
            ->addColumn('action', function ($row) {
                return '<a href="' . route('admin.subscriptions.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>';
            })
            ->rawColumns(['status_badge', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Subscription $model): QueryBuilder
    {
        return $model->newQuery()->with(['user', 'plan']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('subscription-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(5)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::computed('user_name')->title('User'),
            Column::computed('plan')->title('Plan'),
            Column::make('plan_type')->title('Type'),
            Column::computed('status_badge')->title('Status'),
            Column::make('amount'),
            Column::make('expiry_date'),
            Column::make('created_at')->title('Purchased On'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Subscription_' . date('YmdHis');
    }
}
