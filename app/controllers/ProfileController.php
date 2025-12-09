<?php

require_once "../app/Models/User.php";
require_once "../app/Models/Bid.php";
require_once "../app/Models/Auction.php";

class ProfileController extends Controller
{
    private $auctions;
    private $users;
    private $bids;

    public function __construct()
    {
        parent::__construct();
        $this->users = new User();
        $this->bids = new Bid();
        $this->auctions = new Auction();
    }

    public function index()
    {
        if (Auth::isClient()) {
            header("Location: " . BASE_URL . "profile/client");
            exit;
        }

        $this->view("profile/General-profile", [
            "title" => "Profile",
            "layout" => "Main",
            "custom_css" => "profile",
            "user" => Auth::user() ?? []
        ]);
    }
    
    public function client()
    {
        Auth::redirectClient();

        $userId = Auth::user("id");
        $user = $this->users->findById($userId) ?? [];

        $bidHistory = $this->bids->getUserBidHistory($userId) ?? [];
        $wins = 0;
        foreach ($bidHistory as $row) {
            if (!empty($row["is_winner"])) {
                $wins++;
            }
        }

        $memberSince = $user["created_at"] ?? null;

        $this->view("profile/Client-profil", [
            "title" => "My Profile",
            "layout" => "Main",
            "custom_css" => "profile",
            "fullName" => $user["full_name"] ?? "User",
            "email" => $user["email"] ?? "-",
            "initials" => $this->initials($user["full_name"] ?? "U"),
            "auctions" => count($bidHistory),
            "wins" => $wins,
            "memberSince" => $memberSince,
            "memberSinceUi" => $memberSince ? date("M Y", strtotime($memberSince)) : null
        ]);
    }

    private function initials(string $name): string
    {
        $parts = preg_split("/\\s+/", trim($name));
        $initials = "";

        foreach ($parts as $part) {
            if ($part === "") {
                continue;
            }
            $initials .= strtoupper($part[0]);
            if (strlen($initials) >= 2) {
                break;
            }
        }

        return $initials !== "" ? $initials : "U";
    }

    public function myAuctions()
    {
        $userId = Auth::user("id");
        $data = $this->auctions->getMyAuctions($userId);
        $this->view('profile/MyAuction', [
            'auctions' => $data,
            'layout' => "Main",
            "title" => "My Auction",
            "custom_css" => "profileMy"
        ]);
    }

    public function changePassword($id)
    {
        Auth::redirectClient();

        $userId = Auth::user("id");

        // Pastikan user hanya bisa edit password dirinya sendiri
        if ($id != $userId) {
            Session::set("error", "Unauthorized action.");
            header("Location: ".BASE_URL."profile/client");
            exit;
        }

        $old     = trim($_POST['current_password']);
        $new     = trim($_POST['new_password']);
        $confirm = trim($_POST['confirm_new_password']);

        $user = $this->users->findById($userId);

        if (!$user) {
            Session::set("error", "User not found.");
            header("Location: ".BASE_URL."profile/client");
            exit;
        }

        // Validasi: password lama harus cocok
        if (!password_verify($old, $user['password'])) {
            Session::set("error", "Current password is incorrect.");
            header("Location: ".BASE_URL."profile/client");
            exit;
        }

        // Validasi: new == confirm
        if ($new !== $confirm) {
            Session::set("error", "New password does not match confirmation.");
            header("Location: ".BASE_URL."profile/client");
            exit;
        }
        // Update password
        $this->users->update($userId, [
            "password" => $new
        ]);

        Session::set("success", "Password updated successfully.");
        header("Location: ".BASE_URL."profile/client");
        exit;
    }
    
    
}
