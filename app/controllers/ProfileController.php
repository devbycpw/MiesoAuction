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

    
}
