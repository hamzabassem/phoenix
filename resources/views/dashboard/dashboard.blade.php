@extends('dashboard.layout.master')
@section('content')
    <div class="page-wrapper" style="width: 100%;
    margin-left: 0px;
    margin-top: -75px;"
    >
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h3 id="title"
                        class="page-title text-truncate text-dark font-weight-medium mb-1">{{Lang::get('site.Hello')}} {{ucfirst(auth()->user()->name)}}</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{route('dashhome')}}">{{Lang::get('site.Dashboard')}}</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-5 align-self-center">
                    <div class="customize-input float-right">
                        <select
                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                            <option selected>{{date('Y-m-d')}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
        @include('dashboard.layout.messages')
        <!--
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{Lang::get('site.Caregories Information')}}</h4>
                        </div>

                        <input type="text" class="calculator-screen z-depth-1" value="" disabled/>

                        <div class="calculator-keys">

                            <button id="button" type="button" class="operator btn btn-info" value="+">+</button>
                            <button id="button" type="button" class="operator btn btn-info" value="-">-</button>
                            <button id="button" type="button" class="operator btn btn-info" value="*">&times;</button>
                            <button id="button" type="button" class="operator btn btn-info" value="/">&divide;</button>

                            <button id="button" type="button" value="7" class="btn btn-light waves-effect">7</button>
                            <button id="button" type="button" value="8" class="btn btn-light waves-effect">8</button>
                            <button id="button" type="button" value="9" class="btn btn-light waves-effect">9</button>


                            <button id="button" type="button" value="4" class="btn btn-light waves-effect">4</button>
                            <button id="button" type="button" value="5" class="btn btn-light waves-effect">5</button>
                            <button id="button" type="button" value="6" class="btn btn-light waves-effect">6</button>


                            <button id="button" type="button" value="1" class="btn btn-light waves-effect">1</button>
                            <button id="button" type="button" value="2" class="btn btn-light waves-effect">2</button>
                            <button id="button" type="button" value="3" class="btn btn-light waves-effect">3</button>


                            <button id="button" type="button" value="0" class="btn btn-light waves-effect">0</button>
                            <button id="button" type="button" class="decimal function btn btn-secondary" value=".">.</button>
                            <button id="button" type="button" class="all-clear function btn btn-danger btn-sm" value="all-clear">
                                AC
                            </button>

                            <button style="background-color: #1d643b; color: white" type="button"
                                    class="equal-sign operator btn btn-default" value="=">=
                            </button>

                        </div>

                    </div>
                </div>
            </div>
            -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="">
                            <div class="row">
                                {{--<div class="col-lg-3 border-right pr-0">
                                    <div class="card-body border-bottom">
                                        <h4 class="card-title mt-2">Drag & Drop Event</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="calendar-events" class="">
                                                    <div class="calendar-events mb-3" data-class="bg-info"><i
                                                            class="fa fa-circle text-info mr-2"></i>Event One</div>
                                                    <div class="calendar-events mb-3" data-class="bg-success"><i
                                                            class="fa fa-circle text-success mr-2"></i> Event Two
                                                    </div>
                                                    <div class="calendar-events mb-3" data-class="bg-danger"><i
                                                            class="fa fa-circle text-danger mr-2"></i>Event Three
                                                    </div>
                                                    <div class="calendar-events mb-3" data-class="bg-warning"><i
                                                            class="fa fa-circle text-warning mr-2"></i>Event Four
                                                    </div>
                                                </div>
                                                <!-- checkbox -->
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="drop-remove">
                                                    <label class="custom-control-label" for="drop-remove">Remove
                                                        after drop</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>--}}
                                <div class="col-lg-9">
                                    <div class="card-body b-l calender-sidebar">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                                <form method="post" action="{{route('addtask')}}">
                                    @csrf
                                    <div style="margin-top: 105px;" class="row">
                                        <div class="col-md-11 ml-auto">
                                            <div class="form-group">
                                                <label for="name"> Add new task</label>
                                                <input name="name" type="text" class="form-control"
                                                       placeholder="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11 ml-auto">
                                            <div class="form-group">
                                                <label for="name"> Starts at</label>
                                                <input name="start" type="date" class="form-control"
                                                       placeholder="col-md-4 ml-auto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11 ml-auto">
                                            <div class="form-group">
                                                <label for="name"> Ends at</label>
                                                <input name="end" type="date" class="form-control"
                                                       placeholder="col-md-4 ml-auto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-info">Submit</button>
                                            <button type="reset" class="btn btn-dark">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(auth()->user()->level == 1)
            <div class="card-body">
                <h4 class="card-title">Renew your subscription</h4>
            </div>
                <div class="card-group">
                    <a href="{{route('updatedays',['days' => \Illuminate\Support\Facades\Crypt::encryptString(30)])}}"
                       class="card border-right" id="renew">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">30 Days</h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">For 20$</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                                </div>
                            </div>
                        </div>

                    </a>
                    <a href="{{route('updatedays',['days' => \Illuminate\Support\Facades\Crypt::encryptString(365)])}}"
                       class="card border-right" id="renew">

                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">365 Days</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">For 99$
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                                </div>
                            </div>
                        </div>

                    </a>
                </div>
            @endif

        </div>
    </div>
    <style>
        #renew:hover {
            background-color: #cbd3da;
        }

        /*

                .calculator {
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 400px;
                }

                .calculator-screen {
                    width: 38%;
                    height: 80px;
                    border: none;
                    background-color: #252525;
                    color: #fff;
                    text-align: right;
                    padding-right: 20px;
                    padding-left: 10px;
                    font-size: 4rem;
                }

                #button {
                    height: 60px;
                    font-size: 2rem !important;
                }

                .equal-sign {
                    height: 98%;
                    grid-area: 2 / 4 / 6 / 5;
                }

                .calculator-keys {
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    grid-gap: 20px;
                    padding: 20px;
                    width: 40%;
                }
        */

    </style>
    {{--<script>
        const calculator = {
            displayValue: '0',
            firstOperand: null,
            waitingForSecondOperand: false,
            operator: null,
        };

        function inputDigit(digit) {
            const {displayValue, waitingForSecondOperand} = calculator;

            if (waitingForSecondOperand === true) {
                calculator.displayValue = digit;
                calculator.waitingForSecondOperand = false;
            } else {
                calculator.displayValue = displayValue === '0' ? digit : displayValue + digit;
            }
        }

        function inputDecimal(dot) {
            // If the `displayValue` does not contain a decimal point
            if (!calculator.displayValue.includes(dot)) {
                // Append the decimal point
                calculator.displayValue += dot;
            }
        }

        function handleOperator(nextOperator) {
            const {firstOperand, displayValue, operator} = calculator
            const inputValue = parseFloat(displayValue);

            if (operator && calculator.waitingForSecondOperand) {
                calculator.operator = nextOperator;
                return;
            }

            if (firstOperand == null) {
                calculator.firstOperand = inputValue;
            } else if (operator) {
                const currentValue = firstOperand || 0;
                const result = performCalculation[operator](currentValue, inputValue);

                calculator.displayValue = String(result);
                calculator.firstOperand = result;
            }

            calculator.waitingForSecondOperand = true;
            calculator.operator = nextOperator;
        }

        const performCalculation = {
            '/': (firstOperand, secondOperand) => firstOperand / secondOperand,

            '*': (firstOperand, secondOperand) => firstOperand * secondOperand,

            '+': (firstOperand, secondOperand) => firstOperand + secondOperand,

            '-': (firstOperand, secondOperand) => firstOperand - secondOperand,

            '=': (firstOperand, secondOperand) => secondOperand
        };

        function resetCalculator() {
            calculator.displayValue = '0';
            calculator.firstOperand = null;
            calculator.waitingForSecondOperand = false;
            calculator.operator = null;
        }

        function updateDisplay() {
            const display = document.querySelector('.calculator-screen');
            display.value = calculator.displayValue;
        }

        updateDisplay();

        const keys = document.querySelector('.calculator-keys');
        keys.addEventListener('click', (event) => {
            const {target} = event;
            if (!target.matches('button')) {
                return;
            }

            if (target.classList.contains('operator')) {
                handleOperator(target.value);
                updateDisplay();
                return;
            }

            if (target.classList.contains('decimal')) {
                inputDecimal(target.value);
                updateDisplay();
                return;
            }

            if (target.classList.contains('all-clear')) {
                resetCalculator();
                updateDisplay();
                return;
            }

            inputDigit(target.value);
            updateDisplay();
        });
    </script>--}}

    <script src="{{asset('assets/extra-libs/taskboard/js/jquery-ui.min.js')}}"></script>
    <!--This page JavaScript -->
    <script src="{{asset('assets/libs/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/libs/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <script src="{{asset('dist/js/pages/calendar/cal-init.js')}}"></script>
    <link href="{{asset('assets/libs/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet"/>
    <!-- Custom CSS -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">

    <script>
        var defaultEvents = [
                @foreach($tasks as $value)
            {
                title: '{{$value->name}}',
                start: new Date('{{$value->start}}').getTime(),
                end: new Date('{{$value->end}}').getTime() + 86400000,
                className: 'bg-info'
            },
            @endforeach
        ];
    </script>
@endsection
