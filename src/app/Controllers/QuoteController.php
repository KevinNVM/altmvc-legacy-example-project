<?php

class QuoteController extends Controller
{

    public function __construct()
    {
        $this->loadModel('Quote');
    }

    public function index()
    {
        $quote = new Quote();

        $data = array(
            'quotes' => array_reverse($quote->getAll())
        );

        return View::make('quotes/index', $data)
            ->title('Quotes')
            ->withLayout();
    }

    public function show()
    {
        //...
    }

    public function create()
    {
        //...
    }

    public function store()
    {
        $quotes = new Quote();

        $data = $this->parseBody();
        $data['author'] = 'Lorem';

        $quotes->create($data);

        redirect(url('/quotes'));
    }

    public function edit()
    {
        //...
    }

    public function update()
    {
        //...
    }

    public function destroy($id)
    {
        $quote = new Quote();

        $quote->delete($id);

        redirect(url('/quotes'));
    }

}