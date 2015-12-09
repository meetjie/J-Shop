@extends('layouts.admin')
@section('content')
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg">商品管理</strong> / <small>商品品牌</small>
        </div>
    </div>

    @include('layouts._message')

    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <a class="am-btn am-btn-default" href="{{ route('admin.brand.create') }}">
                        <span class="am-icon-plus"></span> 新增
                    </a>
                </div>
            </div>
        </div>

        <form class="" action="/admin/brand/search" method="get">
            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-input-group am-input-group-sm">
                    <input type="text" class="am-form-field" name="keyword">
                    <span class="am-input-group-btn">
                        <button class="am-btn am-btn-default" type="submit">搜索</button>
                    </span>
                </div>
            </div>
        </form>

    </div>

    <div class="am-g">
        <div class="am-u-sm-12">
            <form class="am-form">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                        <tr>
                            <th class="table-id">编号</th>
                            <th class="table-title">品牌名称</th>
                            <th>品牌LOGO</th>
                            <th class="table-type">品牌网址</th>
                            <th class="table-author am-hide-sm-only">品牌描述</th>
                            <th class="table-date am-hide-sm-only">排序</th>
                            <th class="table-date am-hide-sm-only">是否显示</th>
                            <th class="table-set">操作</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach($brands as $brand)
                        <tr>
                            <td class="brand_id">{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td class="brand_logo"><img src="{{ $brand->logo }}" alt="" /></td>
                            <td><a href="{{ $brand->url }}" target="_blank">{{ $brand->url }}</a></td>
                            <td class="am-hide-sm-only">{{ $brand->desc }}</td>
                            <td class="am-hide-sm-only sort_order" contenteditable="true">{{ $brand->sort_order }}</td>
                            <td class="am-hide-sm-only is_brand_show"  style="cursor:pointer" data="{{$brand->is_show}}">
                                @if($brand->is_show == true)
                                    <span class="am-icon-check"></span>
                                @else
                                    <span class="am-icon-close"></span>
                                @endif
                            </td>
                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ route('admin.brand.edit', $brand->id) }}">
                                            <span class="am-icon-pencil-square-o"></span> 编辑
                                        </a>
                                        <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" href="{{ route('admin.brand.destroy', $brand->id) }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="确定删除吗？">
                                            <span class="am-icon-trash-o"></span> 删除
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="am-cf">
                    <div class="am-fr">

                        {!! $brands->render() !!}
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
@stop

@section('js')
<script type="text/javascript">
    $(function(){
        $(".sort_order").blur(function(){
            var data = {
                sort_order : $(this).text(),
                id : $(this).siblings(".brand_id").text()
            }

            $.ajax({
                type: "PATCH",
                url: "/admin/brand/sort",
                data : data,
                dataType: "html",
                // success : function(data){
                //     // console.log(data);
                //     location.href=location.href;
                // }
            });
        });
        $(".is_brand_show").click(function(){
            var data = {
                is_show : $(this).attr("data"),
                id : $(this).siblings(".brand_id").text()
            }
//            console.log(data);
            $.ajax({
                type: "PATCH",
                url: "/admin/brand/is-show",
                data : data,
                dataType: "html",
            })
            if(data["is_show"] == 1){
                $(this).attr("data",0),
                $(this).children("span").attr("class","am-icon-close");
            }else{
                $(this).attr("data",1),
                $(this).children("span").attr("class","am-icon-check");
            }
        })


    })
</script>
@stop
