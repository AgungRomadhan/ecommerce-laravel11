<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Menampilkan halaman utama dengan daftar produk.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::all();

        return view('pages.user.index', compact('products'));
    }

    /**
     * Menampilkan detail produk berdasarkan ID.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function detail_product($id)
    {
        // Mencari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Menampilkan halaman detail produk
        return view('pages.user.detail', compact('product'));
    }

    /**
     * Melakukan pembelian produk oleh user.
     *
     * @param int $productId
     * @param int $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purchase($productId, $userId)
    {
        // Mencari produk dan pengguna berdasarkan ID
        $product = Product::findOrFail($productId);
        $user = User::findOrFail($userId);

        // Mengecek apakah user memiliki poin yang cukup untuk membeli produk
        if ($user->point >= $product->price) {
            // Mengurangi poin pengguna
            $totalPoints = $user->point - $product->price;

            // Memperbarui poin pengguna di database
            $user->update([
                'point' => $totalPoints,
            ]);

            // Menampilkan pesan sukses
            Alert::success('Berhasil!', 'Produk berhasil dibeli!');
            return redirect()->back();
        } else {
            // Menampilkan pesan error jika poin tidak cukup
            Alert::error('Gagal!', 'Poin Anda tidak cukup!');
            return redirect()->back();
        }
    }
}