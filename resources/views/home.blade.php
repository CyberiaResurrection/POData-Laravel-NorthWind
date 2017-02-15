<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
<body style='background-color:#ccffcc'>
                <div style='display:table;'>
                        <div style='float:left;width:150px;'>Version</div>
                        <div style='float:left;'><?php echo $version; ?></div>
                </div>
        <form method='post'>
                <div style='display:table;padding-top:10px;'>
                        <div style='float:left;width:150px;'>API URL</div>
                        <div style='float:left;'><input type='text' name='api' value='<?php echo $url; ?>' size='100'></div>
                </div>
                <div style='display:table;padding-top:10px;'>
                        <div style='float:left;width:150px;'>Request Method</div>
                        <div style='float:left;padding-right:15px;'>
                                <select name='requestMethod'>
<?php
        echo $opt;
?>
                                </select>
                        </div>
                </div>
                <div style='display:table;padding-top:10px;'>
                        <div style='float:left;width:150px;'>Request Header</div>
                        <div style='float:left'>
                                <textarea cols='100' rows='5' name='requestHeader'><?php echo $requestHeaderRaw; ?></textarea>
                        </div>
                </div>
                <div style='display:table;padding-top:10px;'>
                        <div style='float:left;width:150px;'>Request Body</div>
                        <div style='float:left'>
                                <textarea cols='100' rows='10' name='requestBody'><?php echo $requestBody; ?></textarea>
                        </div>
                </div>
                <div style='display:table;padding-top:10px;'>
                        <div style='float:left;width:150px;'>&nbsp;</div>
                        <div style='float:left;padding-left:550px;'><input type='submit'></div>
                </div>
        </form>
                <div style='display:table;padding-top:10px;'>
                        <div style='float:left;width:150px;'>Received Header</div>
                        <div style='float:left'>
                                <textarea cols='100' rows='20' readonly><?php echo $rHeader; ?></textarea>
                        </div>
                </div>
                <div style='display:table;'>
                        <div style='float:left;width:150px;'>Received Data</div>
                        <div style='float:left'>
                                <textarea cols='100' rows='20' readonly><?php echo $rData; ?></textarea>
                        </div>
                </div>
                <div style='display:table;'>
                        <div style='float:left;width:150px;'>Error Message</div>
                        <div style='float:left'>
                                <textarea cols='100' readonly><?php echo $rError; ?></textarea>
                        </div>
                </div>
</body>
</html>
