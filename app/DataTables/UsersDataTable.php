<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<User> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($row){
                $action = '';

                $action .='<a href="'.route('admin.users.profile',['uuid'=>$row->uuid]).'" class="btn btn-primary btn-sm">View</a>'; 
                if( in_array('diet',$row->subscription) || in_array('combo',$row->subscription)){
                    $action .= '<a href="'.route('admin.diet.create',['uuid'=>$row->uuid]).'" class="btn btn-success btn-sm ms-2">Generate Diet</a>';
                }
                return $action; 
            })
            ->editColumn('updated_at',function($row){
                return date('d/m/Y',strtotime($row->updated_at));
            })
            ->editColumn('subscription',function($row){
                $sub = $row->activeSubscription;
                if (!$sub) return '<span class="text-muted">No Plan</span>';
                
                $statusBadge = '';
                if ($sub->status === 'trial') $statusBadge = ' <span class="badge bg-info">Trial</span>';
                elseif ($sub->status === 'pending_payment') $statusBadge = ' <span class="badge bg-warning">Trial Ended</span>';
                elseif ($sub->status === 'active') $statusBadge = ' <span class="badge bg-success">Paid</span>';
                
                return ($sub->plan->name ?? 'Unknown Plan') . '<br>' . $statusBadge;
            })
            ->rawColumns(['subscription', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<User>
     */
    public function query(User $model): QueryBuilder
    {
        $data =  $model->newQuery();
        return $data->where('role','user');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    // ->selectStyleSingle()
                    ->buttons([
                        // Button::make('excel'),
                        // Button::make('csv'),
                        // Button::make('pdf'),
                        // Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
    
            Column::make('first_name'),
            Column::make('last_name'),
            Column::make('email'),
            Column::make('subscription'),
            Column::make('height'),
            Column::make('weight'),
            Column::make('age'),
            Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                //   ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
