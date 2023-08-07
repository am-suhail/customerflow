<?php

namespace App\Http\Livewire\Tables;

use App\Exports\RevenueTableExport;
use App\Models\Invoice;
use Carbon\Carbon;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Invoice::query()
            ->with('activities', 'activities.causer', 'items', 'items.subcategory');
    }

    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('number')
                ->label('Ref Number')
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('date')
                ->label('Revenue Date')
                ->getStateUsing(fn (Invoice $record) => Carbon::parse($record->date)->format('d-m-Y'))
                ->toggleable(),

            TextColumn::make('revenue_type')
                ->label('Company Type')
                ->getStateUsing(fn (Invoice $record) => $record->branch->company->sub_category->category->name ?? "--")
                ->toggleable(),

            TextColumn::make('branch.name')
                ->label('Branch')
                ->limit(25)
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('branch.company.name')
                ->label('Company')
                ->limit(25)
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('branch.country.name')
                ->label('Country')
                ->limit(25)
                ->toggleable()
                ->sortable(),

            TextColumn::make('branch.city.state.name')
                ->label('Zone/District')
                ->limit(25)
                ->toggleable()
                ->sortable(),

            TextColumn::make('branch.city.name')
                ->label('City')
                ->limit(25)
                ->toggleable()
                ->sortable(),

            TextColumn::make('items.selling_price')
                ->label('Sales')
                ->getStateUsing(fn ($record) => $record->items->map(fn ($item) => $item->selling_price)->sum())
                ->toggleable(),

            TextColumn::make('items.additional_charge')
                ->label('Trade')
                ->getStateUsing(fn ($record) => $record->items->map(fn ($item) => $item->additional_charge)->sum())
                ->toggleable()
                ->searchable(),

            TextColumn::make('items.non_trade_revenue')
                ->label('Non Trade')
                ->getStateUsing(fn ($record) => $record->items->map(fn ($item) => $item->non_trade_revenue)->sum())
                ->toggleable()
                ->searchable(),

            TextColumn::make('total_amount')
                ->label('Total Amount')
                ->alignRight()
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('items.tax')
                ->label('No of Invoices')
                ->getStateUsing(fn ($record) => $record->items->map(fn ($item) => $item->tax)->sum())
                ->toggleable()
                ->searchable(),

            TextColumn::make('createdBy')
                ->label('Created By')
                ->getStateUsing(fn (Invoice $record) => $record->activities->where('description', 'created')->first()->causer->name ?? "--")
                ->limit(12)
                ->toggleable(),

            TextColumn::make('created_at')
                ->label('Created On')
                ->getStateUsing(fn (Invoice $record) => Carbon::parse($record->created_at)->format('d-m-Y | h:i:s A'))
                ->toggleable()
                ->searchable(),

            TextColumn::make('status')
                ->label('Status')
                ->getStateUsing(fn () => "--")
                ->toggleable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            ActionGroup::make([
                ViewAction::make('view')
                    ->label("View")
                    ->color('secondary')
                    ->url(fn ($record) => route('revenue.show', $record->id))
                    ->openUrlInNewTab(),

                EditAction::make('edit')
                    ->label("Edit")
                    ->color('primary')
                    ->url(fn ($record) => route('revenue.edit', $record->id)),

                DeleteAction::make("delete")
                    ->label("Delete")
                    ->modalHeading('Delete Revenue Input')
                    ->modalSubheading('Are you sure you\'d like to delete this input? This cannot be undone.')
                    ->visible(fn () => auth()->user()->can('delete revenue'))
            ])
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            Filter::make('date')
                ->form([
                    Forms\Components\DatePicker::make('date_from'),
                    Forms\Components\DatePicker::make('date_until'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['date_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                        )
                        ->when(
                            $data['date_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                        );
                })
                ->label('Date Filter')
        ];
    }

    protected function getTableFiltersFormColumns(): int
    {
        return 4;
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'number';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

    protected function isTableStriped(): bool
    {
        return true;
    }

    protected function shouldPersistTableFiltersInSession(): bool
    {
        return true;
    }

    public function export()
    {
        return Excel::download(new RevenueTableExport(collect($this->getTableRecords()->items())), 'revenue_' . now() . '.xlsx');
    }

    public function render()
    {
        return view('livewire.tables.invoice-table');
    }
}
