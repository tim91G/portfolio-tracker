<?php


namespace App\Remote;

use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;

class PortfolioRepository
{
    function buildPortfolio($stocks, $totalPortfolioValue): Portfolio
    {
        $stocks = collect($stocks);

        $total_invested = $stocks->sum('stock_invested');
        $total_profit = $stocks->sum('ps_profit');

        $portfolio = new Portfolio;
        $portfolio->total_invested = $total_invested;
        $portfolio->total_profit = $total_profit;
        $portfolio->total_growth = ($total_profit / $total_invested) * 100;
        $portfolio->total_current_value = $totalPortfolioValue;

        $matcher = ['user_id' => Auth::id()];
        return Portfolio::updateOrCreate($matcher, [
            'total_invested' => $portfolio->total_invested,
            'total_profit' => $portfolio->total_profit,
            'total_growth' => $portfolio->total_growth,
            'total_current_value' => $portfolio->total_current_value,
        ]);
    }
}
