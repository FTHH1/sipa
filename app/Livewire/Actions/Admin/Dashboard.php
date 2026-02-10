class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalUser' => User::count(),
            'adminCount' => User::whereRole('admin')->count(),
            'petugasCount' => User::whereRole('petugas')->count(),
            'peminjamCount' => User::whereRole('peminjam')->count(),
        ]);
    }
}
