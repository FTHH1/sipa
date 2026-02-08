public function index() {
    $alat = Alat::with('kategori')->get();
    return view('alat.index', compact('alat'));
}