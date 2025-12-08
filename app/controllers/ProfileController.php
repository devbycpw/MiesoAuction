<?php

class ProfileController extends Controller
{
    private $users;

    public function __construct()
    {
        parent::__construct();
        $this->users = $this->model("User");
    }

    /**
     * Default profile entry point.
     * - Guests and admins get the general profile view.
     * - Clients are redirected to their personalized profile.
     */
    public function index()
    {
        $role = Session::get('role') ?? 'guest';

        if ($role === 'client') {
            return $this->client();
        }

        $this->view("profile/General-profile", [
            "title" => "Profile",
            "layout" => "Main",
            "custom_css" => "profile",
            "profileType" => "general",
            "user" => Auth::user(),
        ]);
    }

    /**
     * Client-only profile page.
     */
    public function client()
    {
        Auth::redirectClient();

        $userId = Session::get("user_id");
        $user = $this->users->findById($userId);

        if (!$user) {
            Session::set("error", "Profil tidak ditemukan. Silakan login ulang.");
            header("Location: " . BASE_URL . "logout");
            exit;
        }

        $memberSince = isset($user["created_at"]) ? date("F Y", strtotime($user["created_at"])) : "—";
        $initials = $this->getInitials($user["full_name"] ?? "");

        $stats = [
            "auctions_created" => 0,
            "bids_placed" => 0,
            "wins" => 0,
            "watchlist" => 0,
        ];

        $this->view("profile/Client-profil", [
            "title" => "My Profile",
            "layout" => "Main",
            "custom_css" => "profile",
            "profileType" => "client",
            "user" => $user,
            "memberSince" => $memberSince,
            "initials" => $initials,
            "stats" => $stats,
        ]);
    }

    private function getInitials(string $name): string
    {
        $parts = explode(' ', trim($name));
        $initials = '';
        foreach ($parts as $p) {
            if ($p !== '') {
                $initials .= strtoupper($p[0]);
            }
        }
        return substr($initials, 0, 2);
    }
}
