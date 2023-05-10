@extends("_master.main")
@section("title")  {{$_setting['title']}}  | کاربران @endsection()
@section("main")
    <nav class="bg-gray py-3">
        <div class="container d-flex justify-content-end">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item active text-right" aria-current="page" >لیست کاربران</li>
                <li class="breadcrumb-item text-right" ><a href="/">خانه</a></li>

            </ol>
        </div>
    </nav>
    <div class="section text-right" dir="rtl">
        <div class="user shopping">
            <div class="container-fluid px-5">
                <div class="row">
                    <div class="col-md-12 mx-auto mb-5 ">
                        <table class="table" >
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">تعداد کاربران</th>
                                <th scope="col">کاربران اهراز شده</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="user-count">{{$usersNum}}</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 mx-auto">
                        <div class="block">
                            <div class="product-list" id="user-page">
                                    <div class="table-responsive" style="overflow-y: hidden">
                                        <table class="table user-table table-hover">
                                            <thead>
                                            <tr class="text-center">
                                                <th>نام</th>
                                                <th>نام کاربری</th>
                                                <th>ایمیل</th>
                                                <th>شماره همراه</th>
                                                <th>نقش</th>
                                                <th>آواتار</th>
                                                <th></th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- This user -->
                                            <tr class="text-center user-item">
                                                <td><strong class="text-primary">شما</strong></td>
                                                <td>{{Auth::user()->username}}</td>
                                                <td>{{Auth::user()->email}}</td>
                                                <td>{{Auth::user()->profile->phone ?? 'وارد نشده'}} </td>
                                                <td>{{Auth::user()->role}}</td>
                                                <td><img style="width:60px;height:auto; border-radius: 50%" id="profile" class="media-object user-img" src="{{Auth::user()->profile->image}}" alt="Image"></td>
                                                <td><a href="#" class="btn btn-sm btn-outline-primary"><small style="font-size: .7rem;" class="text-center mt-1 d-inline-block">مشاهده جزئیات</small></a></td>
                                            </tr>

                                            <!-- Other users -->
                                            @foreach ($users as $index=>$user)
                                                @if ($user->id != Auth::user()->id)
                                                    <tr class="text-center user-item ">
                                                        <td class="d-flex">
                                                            <div title="حذف" class="mx-5 remove-user"><a class="user-remove lead"  href="#" >&times;</a></div>
                                                            {{$user->name}}
                                                        </td>
                                                        <td>{{$user->username}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>{{$user->profile->phone ?? 'وارد نشده'}} </td>
                                                        <td class="position-relative">
                                                            <select  class="choose-role" name="user-role" id="select-role-{{hash('crc32',$user->username)}}">
                                                                <option value="admin" {{$user->role == 'admin' ? 'selected' : ''}}>مدیر</option>
                                                                <option value="writer" {{$user->role == 'writer' ? 'selected' : ''}}>نویسنده</option>
                                                                <option value="user" {{$user->role == 'user' ? 'selected' : ''}}>کاربر</option>
                                                            </select>
                                                        </td>
                                                        <td class="setting d-none" id="{{hash('crc32',$user->username)}}"><input type="hidden" name="u-id" value="{{openssl_encrypt($user->id,'AES-128-ECB','!123456ad')}}"></td>
                                                        <td><img style="width:60px;height:auto; border-radius: 50%" id="profile" class="media-object user-img" src="{{$user->profile->image}}" alt="Image"></td>
                                                        <td><a href="#" class="btn btn-sm btn-outline-primary"><small style="font-size: .7rem;" class="text-center mt-1 d-inline-block">مشاهده جزئیات</small></a></td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if ($usersNum > 20)
                                        <hr>
                                            <div class="d-flex flex-column flex-md-row align-items-center">
                                                @include('pagination.default', ['paginator' => $users])
                                            </div>
                                        <hr>
                                    @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('_master.footer')
@endsection
@section('extra_js')
    <script src="/js/manageUsers.js"></script>
@endsection

