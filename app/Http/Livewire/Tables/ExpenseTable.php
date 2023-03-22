<?php

namespace App\Http\Livewire\Tables;

use App\Models\Expense;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;

class ExpenseTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Expense::query()
            ->with('tax');
    }

    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('#')
                ->rowIndex(),

            TextColumn::make('number')
                ->label('Ref Number')
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('date')
                ->label('Accounting Date')
                ->getStateUsing(fn (Expense $record) => Carbon::parse($record->accounting_date)->format('d-m-Y'))
                ->toggleable()
                ->sortable(query: function (Builder $query, string $direction): Builder {
                    return $query
                        ->orderBy('accounting_date', $direction);
                }),

            TextColumn::make('branch.name')
                ->label('Branch')
                ->limit(20)
                ->toggleable()
                ->sortable(),

            // TextColumn::make('branch.country.name')
            //     ->label('Country')
            //     ->limit(25)
            //     ->toggleable()
            //     ->searchable()
            //     ->sortable(),

            // TextColumn::make('branch.city.state.name')
            //     ->label('Zone/District')
            //     ->limit(25)
            //     ->toggleable()
            //     ->searchable()
            //     ->sortable(),

            // TextColumn::make('branch.city.name')
            //     ->label('City')
            //     ->limit(25)
            //     ->toggleable()
            //     ->searchable()
            //     ->sortable(),

            TextColumn::make('sub_category.category.name')
                ->label('Category')
                ->toggleable(),

            TextColumn::make('sub_category.name')
                ->label('Sub Category')
                ->toggleable()
                ->sortable(),

            TextColumn::make('entry_type.name')
                ->label('Expense Type')
                // ->getStateUsing(fn (Expense $record) => "--")
                ->toggleable()
                ->sortable(),

            TextColumn::make('document_number')
                ->label('Invoice Number')
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('amount')
                ->label('Amount')
                ->alignEnd()
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('taxCalc')
                ->label('VAT')
                ->getStateUsing(fn (Expense $record) => $record->tax_calc)
                ->alignEnd()
                ->toggleable()
                ->sortable(),

            TextColumn::make('totalAmount')
                ->label('Total Amount')
                ->getStateUsing(fn (Expense $record) => $record->amount + $record->tax_calc)
                ->alignEnd()
                ->toggleable()
                ->sortable(),

            TextColumn::make('payment_mode')
                ->label('Payment Mode')
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('creator.name')
                ->label('Entry By')
                ->limit(12)
                ->toggleable()
                ->sortable(),

            TextColumn::make('created_at')
                ->label('Entry On')
                ->getStateUsing(fn (Expense $record) => Carbon::parse($record->created_at)->format('d-m-Y | h:i:s A'))
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('description')
                ->label('Description')
                ->toggleable()
                ->searchable(),

            TextColumn::make('remark')
                ->label('Remark')
                ->limit(15)
                ->searchable()
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
                    ->url(fn ($record) => route('expense.show', $record->id))
                    ->openUrlInNewTab(),

                EditAction::make('edit')
                    ->label("Edit")
                    ->color('primary')
                    ->url(fn ($record) => route('expense.edit', $record->id)),

                DeleteAction::make("delete")
                    ->label("Delete")
                    ->modalHeading('Delete Revenue Input')
                    ->modalSubheading('Are you sure you\'d like to delete this input? This cannot be undone.')
                    ->visible(fn () => auth()->user()->can('delete revenue'))
            ])
        ];
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'number';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

    protected function shouldPersistTableFiltersInSession(): bool
    {
        return true;
    }

    public function render()
    {
        return view('livewire.tables.expense-table');
    }
}
