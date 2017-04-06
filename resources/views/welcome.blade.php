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
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div>
            </div>
        </div>
        <script type="text/javascript">
var TemplateComplier = (function () {
    function TemplateComplier() {
        this.evalExpr = /<%=(.+?)%>/g;
        this.expr = /<%([\s\S]+?)%>/g;
    }
    TemplateComplier.prototype.complie = function (template, data) {
        template = template
            .replace(this.evalExpr, '`);\n echo( $1 );\n echo(`')
            .replace(this.expr, '`);\n $1  echo(`');
        template = 'echo(`' + template + '`);';

        var script = "(function parse(data){\n    var output = [];\n\n    function echo(html){\n      output.push(html);\n    }\n\n    " + template + "\n\n    return output.join('');\n  })";
        var parse = eval(script);
        return parse(data);
    };
    return TemplateComplier;
}());
        </script>
    </body>
</html>
