public function kategori() {
    return $this->belongsTo(Kategori::class, 'id_kategori');
}
