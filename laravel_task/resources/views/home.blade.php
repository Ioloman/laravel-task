@extends('base.layout')

@section('title')Лид@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="my-3 col-12 col-sm-10 col-md-9 col-lg-7 mx-auto">
                <div class="card">
                    <div class="card-header text-center">
                        ЛИД
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('send-data')  }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Имя</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Почта</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Телефон</label>
                                <input type="tel" class="form-control" name="phone">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="wantsToBuy">
                                <label class="form-check-label">Хочу купить</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </form>

                    </div>
                    <div class="card-footer">
                        @include('inc.data')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
