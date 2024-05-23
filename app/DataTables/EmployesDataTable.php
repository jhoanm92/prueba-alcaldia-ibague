<?php

namespace App\DataTables;

use App\Models\Employe;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmployesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($employe) {
                $action = '<a href="' . route('edit-employe', $employe->id) . '" class="btn btn-sm btn-primary">Editar</a>';
                /* delete button */
                $action .= '<form action="' . route('delete-employe') . '" method="post" style="display: inline;">';
                $action .= '<input type="hidden" name="id" value="' . $employe->id . '">';
                $action .= csrf_field();
                $action .= '<input type="hidden" name="_method" value="DELETE">';
                $action .= '<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>';
                $action .= '</form>';
                /* end delete button */
                return $action;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Employe $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('department');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('employes-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('identification'),
            Column::make('name'),
            Column::make('lastname'),
            Column::make('phone'),
            Column::make('department.name')->title('Department'),
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
        return 'Employes_' . date('YmdHis');
    }
}
