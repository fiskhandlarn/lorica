@extends('layouts.default')

@section('main')
    <h2>TODO:</h2>
    <ul>
        <li>order</li>
        <li>unsupported:
            <ul>
                <li>auto width columns (class="col", "col-auto")</li>
                <li>Alignment (since we don't have rows) (align-items-*, align-self-*)</li>
                <li>Margin utilities (`m*-auto`)</li>
                <li>Nested content other than other cols</li>
            </ul>
        </li>
        <li>Offset classes (use `start-*` instead)</li>
        <li>IE11:
            <ul>
                <li>        justify-self: end;</li>
            </ul>
        </li>
    </ul>

    <div class="bd-example-row">
        <h2>Mix and match</h2>
        <div class="container">
            <!-- Stack the columns on mobile by making one full-width and the other half-width -->
            <div class="row">
                <div class="col-12 col-md-8">.col-12 .col-md-8</div>
                <div class="col-6 col-md-4">.col-6 .col-md-4</div>
            </div>

            <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
            <div class="row">
                <div class="col-6 col-md-4">.col-6 .col-md-4</div>
                <div class="col-6 col-md-4">.col-6 .col-md-4</div>
                <div class="col-6 col-md-4">.col-6 .col-md-4</div>
            </div>

            <!-- Columns are always 50% wide, on mobile and desktop -->
            <div class="row">
                <div class="col-6">.col-6</div>
                <div class="col-6">.col-6</div>
            </div>
        </div>

        <hr/>

        <h2>Column wrapping</h2>
        <div class="container">
            <div class="row">
                <div class="col-9">.col-9</div>
                <div class="col-4">.col-4<br>Since 9 + 4 = 13 &gt; 12, this 4-column-wide div gets wrapped onto a new line as one contiguous unit.</div>
                <div class="col-6">.col-6<br>Subsequent columns continue along the new line.</div>
            </div>
        </div>
        <hr/>

        <h2>Column breaks</h2>
        <div class="container">
            <div class="row">
                <div class="col-6 col-sm-4">.col-6 .col-sm-4</div>
                <div class="col-6 col-sm-4">.col-6 .col-sm-4</div>

                <!-- Force next columns to break to new line at md breakpoint and up -->
                <div class="w-100 d-none d-md-block"></div>

                <div class="col-6 col-sm-4">.col-6 .col-sm-4</div>
                <div class="col-6 col-sm-4">.col-6 .col-sm-4</div>
            </div>
        </div>

        <hr/>

        <h2>Order classes</h2>
        <div class="container">
            <div class="row">
                <div class="col">
                    First, but unordered
                </div>
                <div class="col order-12">
                    Second, but last
                </div>
                <div class="col order-1">
                    Third, but first
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col order-last">
                    First, but last
                </div>
                <div class="col">
                    Second, but unordered
                </div>
                <div class="col order-first">
                    Third, but first
                </div>
            </div>
        </div>

        <hr/>

        <h2>Offset classes</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-4">.col-md-4</div>
                <div class="col-md-4 offset-md-4">.col-md-4 .offset-md-4</div>
            </div>
            <div class="row">
                <div class="col-md-3 offset-md-3">.col-md-3 .offset-md-3</div>
                <div class="col-md-3 offset-md-3">.col-md-3 .offset-md-3</div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">.col-md-6 .offset-md-3</div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-md-6">.col-sm-5 .col-md-6</div>
                <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">.col-sm-5 .offset-sm-2 .col-md-6 .offset-md-0</div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-5 col-lg-6">.col-sm-6 .col-md-5 .col-lg-6</div>
                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">.col-sm-6 .col-md-5 .offset-md-2 .col-lg-6 .offset-lg-0</div>
            </div>
        </div>

        <hr/>

        <h2>Nesting</h2>
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-8 col-sm-6">
                            Level 2: .col-8 .col-sm-6
                        </div>
                        <div class="col-4 col-sm-6">
                            Level 2: .col-4 .col-sm-6
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr />

        <h2>Mixins</h2>
        <div class="container">
            <div class="example-row">
                <div class="example-content-first">
                    .example-content-first
                </div>
                <div class="example-content-first">
                    .example-content-first
                </div>
            </div>
            <div class="example-row">
                <div class="example-content-main">
                    .example-content-main
                </div>
                <div class="example-content-secondary">
                    .example-content-secondary
                </div>
            </div>
            <div class="example-row">
                <div class="example-content-secondary">
                    .example-content-secondary
                </div>
                <div class="example-content-offset">
                    .example-content-offset
                </div>
            </div>
        </div>

    </div>

@stop
