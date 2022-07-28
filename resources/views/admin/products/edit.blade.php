@extends('master.master')
@section('title')
    Edit Product
@endsection
@section('product-active')
    active
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Edit Product</h3>
        </div>
        <div class="right">
            <a href="" class="btn btn-primary back-btn">
                <i class="fas fa-undo"></i> Back
            </a>    
        </div>
    </div>
@endsection
@section('style')
    <style>
        .sizes,.colors{
            grid-template-columns: repeat(8,1fr);
        }
        .sizes .size,.colors .color{
            cursor: pointer;
        }
        .sizes .size.active{
            background: var(--text-color);
            color: var(--white)
        }
        .colors .color.active{
            border: 1px solid white;
            outline: 2px solid #198754;
            transform: scale(1.1);
        }
        #preview-image{
            width: 300px;
            height: 300px;
            margin: 1rem 0;
        }
        @media(max-width:435px){
            .sizes,.colors{
                grid-template-columns: repeat(5,1fr);
            }
            #preview-image{
                width: 200px;
                height: 200px;
                margin: 1rem 0;
            }
        }
    </style>
@endsection
@section('content')
    <div class="product">
        <form action="{{route('admin.products.update',$product->unique_code)}}" method="POST" enctype="multipart/form-data">
           @csrf 
           @method('PUT')
           <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$product->name)}}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div>
           <div class="form-group mb-3">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price',$product->price)}}">
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div>
           <div class="form-group mb-3">
                <label for="category">Category</label>
                <select name="category" id="category_id" class="form-select @error('category') is-invalid @enderror">
                    <option value="">Select category</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{(old('category')==$category->id?"selected":"")}} @if($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div>  
           <div class="form-group mb-3">
                <label for="brand">Brand</label>
                <select name="brand" id="brand" class="form-select @error('brand') is-invalid @enderror">
                    <option value="">Select Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{$brand->id}}" {{(old('brand')==$brand->id?"selected":"")}} @if($brand->id == $product->brand_id) selected @endif>{{$brand->name}}</option>
                    @endforeach
                </select>
                @error('brand')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div>  
           <div class="form-group mb-3">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                    <option value="">Select gender</option>
                    @foreach ($genders as $gender)
                        <option value="{{$gender->id}}" {{(old('gender')==$gender->id?"selected":"")}} @if($gender->id == $product->gender_id) selected @endif>{{$gender->name}}</option>
                    @endforeach
                </select>
                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div>
            <div class="form-group mb-3">
                <label for="sizes" class="mb-2">Sizes</label><br>
                <div class="sizes">
                    @foreach ($sizes as $size)
                    <div>
                        <input type="checkbox" name="sizes[]" value="{{$size->id}}" id="{{$size->name}}" class="d-none sizeCheck" @if(is_array(old('sizes')) && in_array($size->id, old('sizes'))) checked @endif @if(in_array($size->id,$product_sizes)) checked @endif>
                        <label for="{{$size->name}}" class="size">{{$size->name}}</label> 
                    </div>
                    @endforeach
                </div>
                @error('sizes')
                    <span class="invalid-feedback" role="alert" style="display: block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div> 
           <div class="form-group mb-3">
                <label for="colors" class="mb-2">Colors</label><br>
                <div class="colors">
                    @foreach ($colors as $color)
                    <div>
                        <input type="checkbox" name="colors[]" value="{{$color->id}}" id="{{$color->name}}" class="d-none colorCheck" @if(is_array(old('colors')) && in_array($color->id, old('colors'))) checked @endif @if(in_array($color->id,$product_colors)) checked @endif>
                        <label for="{{$color->name}}" class="color" style="background-color:{{$color->name}}"></label> 
                    </div>
                    @endforeach
                </div>
                @error('colors')
                    <span class="invalid-feedback" role="alert" style="display: block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div> 
           <div class="form-group mb-3">
                <label for="image">New Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                @error('image')
                    <span class="invalid-feedback" role="alert" style="display: block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <img src="{{asset($product->image)}}" alt="" id="preview-image">
           </div>
           <div class="form-group mb-3">
                <label for="detail">Detial</label>
                <textarea name="detail" id="detail" class="form-control @error('detail') is-invalid @enderror">{{$product->detail}}</textarea>
                @error('detail')
                    <span class="invalid-feedback" role="alert" style="display: block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div>
           <div class="form-group">
                <button type=submit class="btn btn-primary">Update</button>
           </div>
        </form>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function () {

        $('.sizes input:checked').each(function() {
            var parent=$(this).parent();
            $('.size',parent).toggleClass('active');
        });

        $('.colors input:checked').each(function() {
            var parent=$(this).parent();
            $('.color',parent).toggleClass('active');
        });

        $('.sizeCheck').click(function(){
            var parent=$(this).parent();
            $('.size',parent).toggleClass('active');
        })
        $('.colorCheck').click(function(){
            var parent=$(this).parent();
            $('.color',parent).toggleClass('active');
        })
        ClassicEditor
        .create( document.querySelector( '#detail' ),{
             removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed','Table','BlockQuote',],
        } )
        .catch( error => {
            console.error( error );
        } );

        $('#image').change(function(){
            
            let reader = new FileReader();
            reader.onload = (e) => { 
            $('#preview-image').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
    });
</script>
@endsection