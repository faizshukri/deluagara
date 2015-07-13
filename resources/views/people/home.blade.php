@extends('layouts/master')

@section('content')
    <p class="clearfix">&nbsp;</p>
    <div class="row">
        <div class="col-md-3">
            <form action="">

                {{-- Name --}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>

                {{-- City --}}
                <div class="form-group">
                    <label for="city">City (e.g Manchester)</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="City (e.g Manchester)">
                </div>

                {{-- Gender --}}
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select type="text" class="form-control" id="gender" name="gender">
                        <option value="">Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label>Status</label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=""> Undergraduate Student
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=""> Postgraduate Student
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=""> Working
                        </label>
                    </div>
                </div>

                {{-- Scholarship --}}
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select type="text" class="form-control" id="gender" name="gender">
                        <option value="">Select scholarship</option>
                        <option value="mara">MARA</option>
                        <option value="jpa">JPA</option>
                        <option value="ptptn">PTPTN</option>
                    </select>
                </div>

            </form>
        </div>
        <div class="col-md-9">
            content
        </div>
    </div>
@endsection