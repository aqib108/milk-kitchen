@extends('layouts.customer')

@section('content')
    <div class="container">
        <div>
            <div class="text-center">
                <h2 class="heading-wrapper">MANAGE YOUR ACCOUNT</h2>
            </div>
            <div>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header text-right card-header-custm" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link color-dark" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>

                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body p-0">
                                <div class="form-container">
                                    <div class="row">
                                        <div class="col-lg-6 border-riht-clr">
                                            <div>
                                                <h2 class="heading-inner-top">Business Details</h2>
                                            </div>
                                            <form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">Delivery Details
                                                        </label>
                                                        <input type="text" class="form-control" id=""
                                                            placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">Address 1</label>
                                                        <input type="text" class="form-control" id=""
                                                            placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">Address 2 </label>
                                                        <input type="text" class="form-control" id="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">Suburb</label>
                                                        <input type="text" class="form-control" id="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">City</label>
                                                        <input type="text" class="form-control" id="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">Region</label>
                                                        <input type="text" class="form-control" id="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">Phone</label>
                                                        <input type="number" class="form-control" id="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">Email</label>
                                                        <input type="email" class="form-control" id="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">Contact</label>
                                                        <input type="text" class="form-control" id="">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-6">
                                            <div>
                                                <h2 class="heading-inner-top">Delivery Details</h2>
                                            </div>
                                            <form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">Delivery Details
                                                        </label>
                                                        <input type="text" class="form-control" id=""
                                                            placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">Address 1</label>
                                                        <input type="text" class="form-control" id=""
                                                            placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">Address 2 </label>
                                                        <input type="text" class="form-control" id="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">Suburb</label>
                                                        <input type="text" class="form-control" id="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">City</label>
                                                        <input type="text" class="form-control" id="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="">Region</label>
                                                        <input type="text" class="form-control" id="">
                                                    </div>
                                                    <div class="form-group col-md-6 p-0">
                                                        <label class="label-wrapper-custm" for="">Past order</label>
                                                        <div class="form-inner-section">
                                                            <a href="#" class="view-mdl-wrapper" data-toggle="modal"
                                                            data-target="#exampleModalCenter">view</a>
                                                        </div>
                                                        <div class="form-inner-section">
                                                            <a href="#" style="visibility: hidden;">view</a>
                                                        </div>

                                                    </div>

                                                    <div class="form-group col-md-6 p-0">
                                                        <label class="label-wrapper-custm" for="">Next DD
                                                            payments</label>
                                                        <p class="form-inner-section">$159.65 </p>
                                                        <p class="form-inner-section">8/23/2021</p>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- ===========================Modal======================== -->
                                    <!-- ===========================Modal======================== -->
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Product 1</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        <img src="images/popup.png" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="row mb-40-wrapper">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="" class="label-wrapper-custm">Delivery Notes</label>
                                                <textarea class="form-control" id="" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div>
                <h2 class="heading-tbl">This Weeks Deliveries</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th class="table-th-wrapper" scope="col"></th>
                            <th class="table-th-wrapper" scope="col">Monday</th>
                            <th class="table-th-wrapper" scope="col">Tuesday</th>
                            <th class="table-th-wrapper" scope="col">Wednesday</th>
                            <th class="table-th-wrapper" scope="col">Thursday</th>
                            <th class="table-th-wrapper" scope="col">Friday</th>
                            <th class="table-th-wrapper" scope="col">Saturday</th>
                            <th class="table-th-wrapper" scope="col">Sunday</th>

                        </tr>
                    </thead>
                    <tbody class="week-container-tbl">
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 1</td>
                            <td>3</td>
                            <td>4</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 2</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>5</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 3</td>
                            <td></td>
                            <td>6</td>
                            <td></td>
                            <td></td>
                            <td>4</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 4</td>
                            <td>4</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>8</td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 5</td>
                            <td>2</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>9</td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 6</td>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>5</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 7</td>
                            <td></td>
                            <td>4</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>2</td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 8</td>
                            <td></td>
                            <td></td>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>1</td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 9</td>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>9</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 10</dh>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>1</td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- 2nd  -->
        <div class="mb-40-wrapper">
            <div>
                <h2 class="heading-tbl">Weekly Standing Order</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th class="table-th-wrapper" scope="col"></th>
                            <th class="table-th-wrapper" scope="col">Monday</th>
                            <th class="table-th-wrapper" scope="col">Tuesday</th>
                            <th class="table-th-wrapper" scope="col">Wednesday</th>
                            <th class="table-th-wrapper" scope="col">Thursday</th>
                            <th class="table-th-wrapper" scope="col">Friday</th>
                            <th class="table-th-wrapper" scope="col">Saturday</th>
                            <th class="table-th-wrapper" scope="col">Sunday</th>

                        </tr>
                    </thead>
                    <tbody class="week-container-tbl">
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 1</td>
                            <td>3</td>
                            <td>4</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 2</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>5</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 3</td>
                            <td></td>
                            <td>6</td>
                            <td></td>
                            <td></td>
                            <td>4</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 4</td>
                            <td>4</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>8</td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 5</td>
                            <td>2</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>9</td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 6</td>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>5</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 7</td>
                            <td></td>
                            <td>4</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>2</td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 8</td>
                            <td></td>
                            <td></td>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>1</td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 9</td>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>9</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 10</dh>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>1</td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection   