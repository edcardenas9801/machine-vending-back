<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Inventory;
use App\Models\Machine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VendingMachineController extends Controller
{

    public function getArticles(): JsonResponse
    {
        try {
            $articles = Article::all();
            return response()->json(['message' => 'Successful query', 'data' => $articles]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => 'Error'], 500);
        }
    }

    public function buyArticle(Request $request): JsonResponse
    {
        $articleId = $request->input('productId');
        $userBalance = round($request->input('userBalance'), 2);
        $coins = $request->input('coins');

        $article = Article::find($articleId);

        if (!$article) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        if ($userBalance >= $article->price) {
            $change = round(($userBalance - floatval($article->price)), 2);

            DB::beginTransaction();
            try {
                $inventory = Inventory::where('article_id', $articleId)->first();
                if (!$inventory) {
                    return response()->json(['error' => 'This product does not exist in inventory'], 404);
                }
                if ($inventory->quantity_available == 0) {
                    return response()->json(['error' => 'There are no quantities available, choose another product'], 202);
                }
                if (!$this->calculateChange($change)) {
                    return response()->json(['error' => 'There is no change at the moment'], 202);
                }

                $inventory->quantity_available = $inventory->quantity_available - 1;
                $inventory->purchased_amount = $inventory->purchased_amount + 1;
                $inventory->save();

                $this->saveCoinsMachine($coins);

                DB::commit();
                return response()->json(['message' => 'Purchased product', 'change' => $change]);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e);
                return response()->json(['error' => 'Error purchasing the product'], 500);
            }
        } else {
            return response()->json(['error' => 'Insufficient balance'], 202);
        }
    }

    public function calculateChange($change): bool
    {
        $machine = Machine::first();

        while ($change > 0) {
            if ($change >= 1 && $machine->coin_1 > 0) {
                $change -= 1;
                $machine->coin_1--;
            } elseif ($change >= 0.25 && $machine->coin_025 > 0) {
                $change -= 0.25;
                $machine->coin_025--;
            } elseif ($change >= 0.10 && $machine->coin_010 > 0) {
                $change -= 0.10;
                $machine->coin_010--;
            } elseif ($change >= 0.05 && $machine->coin_005 > 0) {
                $change -= 0.05;
                $machine->coin_005--;
            } else {
                break;
            }
        }

        if ($change == 0) {
            $machine->save();
            return true;
        } else {
            return false;
        }
    }

    public function saveCoinsMachine($coins): bool
    {
        try {
            $machine = Machine::first();
            if ($coins['coin_1'] > 0) {
                $machine->coin_1 = $machine->coin_1 + $coins['coin_1'];
            }
            if ($coins['coin_005'] > 0) {
                $machine->coin_005 = $machine->coin_005 + $coins['coin_005'];
            }
            if ($coins['coin_010'] > 0) {
                $machine->coin_010 = $machine->coin_010 + $coins['coin_010'];
            }
            if ($coins['coin_025'] > 0) {
                $machine->coin_025 = $machine->coin_025 + $coins['coin_025'];
            }
            $machine->save();
            return true;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }

}
