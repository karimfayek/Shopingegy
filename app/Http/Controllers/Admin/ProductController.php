<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\BrandContract;
use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreProductFormRequest;

class ProductController extends BaseController
{
    protected $brandRepository;

    protected $categoryRepository;

    protected $productRepository;

    public function __construct(
        BrandContract $brandRepository,
        CategoryContract $categoryRepository,
        ProductContract $productRepository
    )
    {
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
		
        $products = \App\Models\Product::all();

        $this->setPageTitle('Products', 'Products List');
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $brands = $this->brandRepository->listBrands('name', 'asc');
        $categories = $this->categoryRepository->listCategories('name', 'asc');

        $this->setPageTitle('Products', 'Create Product');
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(StoreProductFormRequest $request)
    {
        $params = $request->except('_token');

        $product = $this->productRepository->createProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while creating product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Product added successfully' ,'success',false, false);
    }

    public function edit($id)
    {
        $product = $this->productRepository->findProductById($id);
        $brands = $this->brandRepository->listBrands('name', 'asc');
        $categories = $this->categoryRepository->listCategories('name', 'asc');

        $this->setPageTitle('Products', 'Edit Product');
        return view('admin.products.edit', compact('categories', 'brands', 'product'));
    }

    public function update(StoreProductFormRequest $request)
    {
        $params = $request->except('_token');

        $product = $this->productRepository->updateProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while updating product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Product updated successfully' ,'success',false, false);
    }
    public function quantity(Request $request , $id)
    {
        
        $page = $this->productRepository->findProductById($id);
        $page->quantity = $request->quantity ;
        $page->save() ; 
        return response(array(
                'success' => true,
                'message' => 'updated'
            ),200,[]);
    }
    public function price(Request $request , $id)
    {
        
        $page = $this->productRepository->findProductById($id);
        $page->price = $request->price;
        $page->save() ; 
        return response(array(
                'success' => true,
                'message' => 'updated'
            ),200,[]);
    }

 public function saleprice(Request $request , $id)
    {
        
        $page = $this->productRepository->findProductById($id);
        $page->sale_price = $request->price;
        $page->save() ; 
        return response(array(
                'success' => true,
                'message' => 'updated'
            ),200,[]);
    }
	public function delete($id)
    {
        $product = $this->productRepository->deleteProduct($id);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while deleting Product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Product deleted successfully' ,'success',false, false);
    }

}
