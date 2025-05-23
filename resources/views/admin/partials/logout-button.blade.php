<form action="{{ route('login.logout') }}" method="POST" id="logout-form" style="display:inline;">
    @csrf
    <button type="submit" class="logout-btn" style="background-color: #dc3545; color: #fff; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; margin-top: 10px;">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </button>
</form>
