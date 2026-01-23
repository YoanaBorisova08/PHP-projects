<?php
include './inc/functions.inc.php';
include './inc/images.inc.php';

?>
<?php include './views/header.php'; ?>

<?php if(!empty($_GET['image']) && !empty($imageTitles[$_GET['image']])):?>
    <?php $image=$_GET['image']; ?>
    <h2><?php echo e($imageTitles[$image]); ?></h2>
    <img src="./images/<?php echo rawurldecode($image)?>" />
    <p> <?php echo str_replace("\n", "|<br />", e($imageDescriptions[$image])); ?></p>
<?php else: ?>
    <div class="notice">
        This image could not be found.
    </div>
<?php endif; ?>

<a href="gallery.php">Back to gallery!</a>

<?php include './views/footer.php'; ?>
<?php
$emailTemplate = "Dear [NAME],\n\nWe're excited to share with you this week's featured article:\n\n[ARTICLE]\n\nUpcoming Events:\n[EVENTS]\n\nBest regards,\nYour Friendly Team";
$recipient = ['name' => 'Alice', 'segment' => 'Tech Enthusiast', 'email' => 'alice@example.com'];
$segmentContent = [
    'Tech Enthusiast' => "The Latest in Tech: Top Gadgets",
    'Health Guru' => "Transform Your Lifestyle: The Best of Health and Fitness",
];
$events = [
    "Webinar on Future Tech Trends", 
    "Photography Workshop", 
    "Health and Wellness Retreat"
];

$personalizedEmail = str_replace("[NAME]", $recipient['name'], $emailTemplate);
$personalizedEmail = str_replace("[ARTICLE]", $segmentContent[$recipient['segment']], $personalizedEmail);
$events_formated = [];
foreach($events as $e){
    $events_formated[] = "- {$e}";
}
$personalizedEmail = str_replace("[EVENTS]", implode("\n", $events_formated), $personalizedEmail);
echo $personalizedEmail;
?>