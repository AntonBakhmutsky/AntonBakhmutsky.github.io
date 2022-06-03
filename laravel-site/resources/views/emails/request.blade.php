<b>Заявка с сайта №{{ $request->id }}</b>
{{ $request->name }}
{{ $request->phone }}
{{ $request->product?->name }} ({{ $request->product?->vendor_code }})
