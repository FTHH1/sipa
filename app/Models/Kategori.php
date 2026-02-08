public function alat() {
    return $this->hasMany(Alat::class, 'id_kategori');
}