<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid;
use Encore\Admin\Grid\Exporter;
use Encore\Admin\Grid\Exporters\AbstractExporter;

class CsvExporter extends AbstractExporter
{
    protected $grid_exporter;

    public function __construct(Grid $grid = null)
    {
        if (!is_null($grid)) $this->grid_exporter = $grid;
    }

    /**
     * {@inheritdoc}
     */
    public function export()
    {
        if (is_null($this->grid_exporter)) abort(403);
        $this->withScopeWithGrid(request(Exporter::$queryName), $this->grid_exporter);
        $this->grid_exporter->disableRowSelector();
        $this->grid_exporter->disableActions();
        $this->grid_exporter->build();

        $filename = $this->getTable().'.csv';

        $headers = [
            'Content-Encoding'    => 'UTF-8',
            'Content-Type'        => 'text/csv;charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        response()->stream(function () {
            $handle = fopen('php://output', 'w');

            $columns = collect([]);
            foreach ($this->grid_exporter->columns() as $column) {
                $columns->push(['label' => $column->getLabel(), 'name' => $column->getName()]);
            }

            // Add CSV headers
            fputcsv($handle, $columns->pluck('label')->all());

            foreach ($this->grid_exporter->rows() as $row) {
                $data = collect([]);
                foreach ($columns->pluck('name')->all() as $name) {
                    $data->push(array_get($row->model(), $name));
                }
                fputcsv($handle, $data->all());
            }

            // Close the output stream
            fclose($handle);
        }, 200, $headers)->send();

        exit;
    }

    public function withScopeWithGrid($scope, $grid)
    {
        if ($scope == Grid\Exporter::SCOPE_ALL) {
            return;
        }

        list($scope, $args) = explode(':', $scope);

        if ($scope == Grid\Exporter::SCOPE_CURRENT_PAGE) {
            $grid->model()->usePaginate(true);
        }

        if ($scope == Grid\Exporter::SCOPE_SELECTED_ROWS) {
            $selected = explode(',', $args);
            $grid->model()->whereIn($grid->getKeyName(), $selected);
        }

        return;
    }
}
