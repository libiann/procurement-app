<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

    <link rel="stylesheet" href="{{ public_path('invoice.css') }}" type="text/css">

    <style type="text/css">
        body {

            font-family: system-ui, system-ui, sans-serif;

        }

        table {

            border-spacing: 0;

        }

        table td,
        table th,
        p {

            font-size: 13px !important;

        }

        img {

            border: 3px solid #F1F5F9;

            padding: 6px;

            background-color: #F1F5F9;

        }

        .table-no-border {

            width: 100%;

        }

        .table-no-border .width-50 {

            width: 50%;

        }

        .table-no-border .width-70 {

            width: 70%;

            text-align: left;

        }

        .table-no-border .width-30 {

            width: 30%;

        }

        .margin-top {

            margin-top: 40px;

        }

        .product-table {

            margin-top: 20px;

            width: 100%;

            border-width: 0px;

        }

        .product-table thead th {

            background-color: #60A5FA;

            color: white;

            padding: 5px;

            text-align: left;

            padding: 5px 15px;

        }

        .width-20 {

            width: 20%;

        }

        .width-50 {

            width: 50%;

        }

        .width-25 {

            width: 25%;

        }

        .width-70 {

            width: 70%;

            text-align: right;

        }

        .product-table tbody td {

            background-color: #F1F5F9;

            color: black;

            padding: 5px 15px;

        }

        .product-table td:last-child,
        .product-table th:last-child {

            text-align: right;

        }

        .product-table tfoot td {

            color: black;

            padding: 5px 15px;

        }

        .footer-div {

            background-color: #F1F5F9;

            margin-top: 100px;

            padding: 3px 10px;

        }
    </style>

</head>

<body>




    <div class="margin-top">

        <table class="table-no-border">

            <tr>

                <td class="width-50">

                    <div><strong>Order No:</strong> {{ $orders->order_no }}</div>

                    <div><strong>Order Date:</strong> {{ $orders->order_date }}</div>

                    <div><strong>Supplier:</strong> {{ $orders->supplier_name }}</div>

                </td>

            </tr>

        </table>

    </div>



    <div>

        <table class="product-table">

            <thead>

                <tr>

                    <th>

                        <strong>Item No</strong>

                    </th>

                    <th>

                        <strong>Item Name</strong>

                    </th>

                    <th>

                        <strong>Stock Unit</strong>

                    </th>

                    <th>

                        <strong>Unit Price</strong>

                    </th>

                    <th>

                        <strong>Packing Unit</strong>

                    </th>

                    <th>

                        <strong>Order Quantity</strong>

                    </th>

                    <th>

                        <strong>Item Amount</strong>

                    </th>

                    <th>

                        <strong>Discount</strong>

                    </th>

                    <th>

                        <strong>Net Amount</strong>

                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach ($purchase_items as $value)
                    <tr>

                        <td>

                            {{ $value['item_no'] }}

                        </td>

                        <td>

                            {{ $value['item_name'] }}

                        </td>

                        <td>

                            {{ $value['stock_unit'] }}

                        </td>

                        <td>

                            {{ $value['unit_price'] }}

                        </td>

                        <td>

                            {{ $value['packing_unit'] }}

                        </td>

                        <td>

                            {{ $value['order_qty'] }}

                        </td>

                        <td>

                            {{ $value['item_amount'] }}

                        </td>

                        <td>

                            {{ $value['item_discount'] }}

                        </td>

                        <td>

                            {{ $value['item_net_amount'] }}

                        </td>

                    </tr>
                @endforeach

            </tbody>

            <tfoot>

                <tr>

                    <td class="width-70" colspan="2">

                        <strong>Item Total:</strong>

                    </td>

                    <td class="width-25">

                        <strong>{{ $orders['item_total'] }}</strong>

                    </td>

                </tr>

                <tr>

                    <td class="width-70" colspan="2">

                        <strong>Discount:</strong>

                    </td>

                    <td class="width-25">

                        <strong>{{ $orders['discount'] }}</strong>

                    </td>

                </tr>

                <tr>

                    <td class="width-70" colspan="2">

                        <strong>Net Amount:</strong>

                    </td>

                    <td class="width-25">

                        <strong>{{ $orders['net_amount'] }}</strong>

                    </td>

                </tr>

            </tfoot>

        </table>

    </div>

</body>

</html>
