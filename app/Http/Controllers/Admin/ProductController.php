<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Distributor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facedes\Alert;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?');

        return view('pages.admin.product.index', compact('products'));
    
        $data = DB::table('distributors')
                ->join('products', 'distributors.id', '=', 'products.id_distributor')
                ->select('distributors.*', 'products.*')
                ->get();

        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?');

        return view('pages.admin.product.index', compact('data'));
    }
    public function create()
    {
        $distributor = Distributor::all();

        return view('pages.admin.product.create', compact('distributor'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_distributor' => 'required|numeric',
            'name' => 'required',
            'price' => 'numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back();
        }

        $price = $price->price;
        $diskon = $request->diskon ?? 0;
        $price_after_diskon = $diskon ? $price * (1 - $diskon / 100) : $price;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.'. $image->getClientOriginalExtension();
            $image->move('images/', $imageName);
        }

        $product = Product::create([
            'id_distributor' => $request->id_distributor,
            'name' => $request->name,
            'price' => $request->price,
            'priceSdiskon' => $price_after_diskon,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imageName,
            'diskon' => $request->diskon,
        ]);

        if ($product) {
            Alert::success('Berhasil!', 'Produk berhasil ditambahkan!');
            return redirect()->route('admin.product');
       } else {
        Alert::error('Gagal!', 'Produk gagal ditambahkan!');
        return redirect()->back();
        }
    }

    public function detail($id)
    {
            $product = Product::findOrFail($id);

            return view('pages.admin.product.detail', compact('product'));
        
            $data = DB::table('distributors')
                    ->join('products', 'distributors.id', '=', 'products.id_distributor')
                    ->select('products.*', 'distributors.*')
                    ->where('products.id', '=', $id)
                    ->first();
                
            return view('pages.admin.product.detail', compact('data'));
        }
    
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $distributor = Distributor::all();

        return view('pages.admin.product.edit', compact('product', 'distributor'));
        }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_distributor' => 'required|numeric',
            'name' => 'required',
            'price' => 'numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpeg,jpg',
            'diskon' => 'nullable|numeric|min:0|max:100',
    ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back();
        }

        $product = Product::findOrFail($id);

        $price = $request_>price;
        $diskon = $request->diskon;
        $price_after_diskon = $diskon ? $price * (1 - $diskon / 100) : $price;

        if ($request->hasFile('image')) {
            $oldPath = public_path('images/' . $product->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images/', $imageName);
        } else {
            $imageName = $product->image;
        }

        $product->update([
            'id_distributor' => $request->id_distributor,
            'name' => $request->name,
            'price' => $request->price,
            'priceSdiskon' => $price_after_diskon,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imageName,
            'diskon' => $diskon,
        ]);

        if ($product) {
            Alert::success('Berhasil!', 'Produk berhasil diperbarui!');
            return redirect()->route('admin.product');
        } else {
            Alert::error('Gagal!', 'Produk gagal diperbarui!');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $prooduct = Product::findOrFail($id);

        $oldPath = public_path('images/' . $product->image);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }

        $product->delete();

        if ($product) {
            Alert::success('Berhasil!', 'Produk berhasil dihapus!');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Produk gagal dihapus!');
            return redirect()->back();
        }
    }   
}